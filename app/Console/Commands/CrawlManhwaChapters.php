<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Manhwa;
use App\Models\Chapter;
use App\Models\WpMangaChapter;
use App\Models\WpPostMeta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class CrawlManhwaChapters extends Command
{
    protected $signature = 'crawl:manhwa-chapters';
    protected $description = 'Crawl for new manhwa chapters and update the database';
    protected $httpClient;

    public function __construct()
    {
        parent::__construct();
        $this->httpClient = new Client();
    }

    public function handle()
    {
        $manhwas = Manhwa::orderBy('id', 'ASC')->get();
        foreach ($manhwas as $manhwa) {
            Log::info("{$manhwa->id} Checking for new chapters for: {$manhwa->name}");
            $this->info("{$manhwa->id} Checking for new chapters for: {$manhwa->name}");

            // Check Manhwaclan
            if (!empty($manhwa->manhwaclan_link)) {
                $this->checkChapters($manhwa, $manhwa->manhwaclan_link, 'manhwaclan');
            } else {
                Log::info("{$manhwa->id} No Manhwaclan link for: {$manhwa->name}");
                $this->info("{$manhwa->id} No Manhwaclan link for: {$manhwa->name}");
            }
            // Check Manhuafast
            if (!empty($manhwa->asuracomic_link)) {
                $this->checkChapters($manhwa, $manhwa->asuracomic_link, 'asuracomic');
            } else {
                Log::info("{$manhwa->id} No Asuracomic link for: {$manhwa->name}");
                $this->info("{$manhwa->id} No Asuracomic link for: {$manhwa->name}");
            }
            // // Check Manhuafast
            // if (!empty($manhwa->mgdemon_link)) {
            //     $this->checkChapters($manhwa, $manhwa->mgdemon_link, 'mgdemon');
            // } else {
            //     Log::info("{$manhwa->id} No MGdemon link for: {$manhwa->name}");
            //     $this->info("{$manhwa->id} No MGdemon link for: {$manhwa->name}");
            // }
            // Check Manhuafast
            if (!empty($manhwa->manhwafast_link)) {
                $this->checkChapters($manhwa, $manhwa->manhwafast_link, 'manhuafast');
            } else {
                Log::info("{$manhwa->id} No Manhuafast link for: {$manhwa->name}");
                $this->info("{$manhwa->id} No Manhuafast link for: {$manhwa->name}");
            }


            if (!empty($manhwa->tecnoscans_link)) {
                $this->checkChapters($manhwa, $manhwa->tecnoscans_link, 'tecnoscans');
            } else {
                Log::info("{$manhwa->id} No Manhwaclan link for: {$manhwa->name}");

                $this->info("{$manhwa->id} No Manhwaclan link for: {$manhwa->name}");
            }
        }

        Log::info("Crawling completed.");
        $this->info('Crawling completed.');
    }

    protected function checkChapters($manhwa, $url, $source)
    {
        $htmlContent = $this->httpClient->get($url)->getBody()->getContents();
        $crawler = new \Symfony\Component\DomCrawler\Crawler($htmlContent);
        // Validate the URL
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            Log::info("{$manhwa->id} Invalid URL: {$url}");
            $this->error("{$manhwa->id} Invalid URL: {$url}");
            return;
        }

        // Determine which script to use based on the source
        if ($source == 'manhuafast' || ($manhwa->deep_check && $source == 'tecnoscans')) {

            // if ($source == 'manhuafast') {
            $script = 'fetch_chapters_manhuafast.cjs';
            // } else if ($source == 'manhwaclan') {
            //     $script = 'fetch_chapters_manhwaclan.cjs';
            // }
            if ($manhwa->deep_check && $source == 'tecnoscans') {
                Log::info("{$manhwa->id} deep checking for chapters...");

                $script = 'fetch_deep_check_chapters_tecnoscans.cjs';
                $url = Chapter::where('manhwa_id', $manhwa->id)->where('source', 'tecnoscans')->first()->link;
                $url = json_decode($url)[0];
            }

            // Log the command being executed
            // if($manhwa->deep_check && $source == 'tecnoscans'){
            //     $script = 'fetch_deep_check_chapters_tecnoscans.cjs';
            //     $command = "node scripts/{$script} {$url} 2>&1";
            //     Log::info("Executing command: {$command}");
            // }else{
            $command = "node scripts/{$script} {$url} 2>&1";
            Log::info("{$manhwa->id} Executing command: {$command}");

            // }
            // Execute the command and capture output
            $output = shell_exec($command);
            // dd($output);
            if ($output === null) {
                Log::error("{$manhwa->id} Failed to execute script for {$source}");
                $this->error("{$manhwa->id} Failed to execute script for {$source}");
                return;
            }

            // Log::info("Raw output from script: {$output}");


            // Decode the output
            $chapters = json_decode($output, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error("{$manhwa->id} Failed to decode chapters from {$source}. Error: " . json_last_error_msg());
                $this->error("{$manhwa->id} Failed to decode chapters from {$source}. Error: " . json_last_error_msg());
                $this->error($output);  // Show the raw output for debugging
                return;
            }
        } else {
            if ($source == 'mgdemon') {
                // Extract chapter links and numbers
                $chapters = $crawler->filter('#chpagedlist li a')->each(function ($node) {
                    $text = $node->filter('.chapter-title')->text();
                    $chapterNumber = null;

                    // Extract the chapter number from the text
                    if (preg_match('/\d+/', $text, $matches)) {
                        $chapterNumber = $matches[0];
                    }

                    return [
                        'url' => 'https://mgdemon.org/' . $node->attr('href'),
                        'number' => $chapterNumber
                    ];
                });

                // Filter out invalid chapters
                $chapters = array_filter($chapters, function ($chapter) {
                    return $chapter['number'] !== null;
                });
            } else if ($source == 'asuracomic') {
                // Extract chapter links, numbers, and titles
                $chapters = $crawler->filter('.pl-4.pr-2.pb-4 .group')->each(function ($node) {
                    $linkElement = $node->filter('h3 a');
                    $title = $linkElement->text();

                    // Extract the chapter number using regex
                    $chapterNumber = null;
                    if (preg_match('/\d+/', $title, $matches)) {
                        $chapterNumber = $matches[0];
                    }

                    return [
                        'url' => 'https://asuracomic.net/series/' . $linkElement->attr('href'),
                        'number' => $chapterNumber,
                        'title' => trim($title)
                    ];
                });

                // Filter out invalid chapters
                $chapters = array_filter($chapters, function ($chapter) {
                    return $chapter['number'] !== null;
                });
            } else if ($source == 'manhwaclan') {
                // Extract chapter links and numbers
                $chapters = $crawler->filter('.listing-chapters_wrap .wp-manga-chapter a')->each(function ($node) {
                    $text = $node->text();

                    // Extract the chapter number using regex
                    $chapterNumber = null;
                    if (preg_match('/chapter\s*[\d.]+/i', $text, $matches)) {
                        $chapterNumber = preg_replace('/chapter\s*/i', '', $matches[0]);
                    }

                    return [
                        'url' => $node->attr('href'),
                        'number' => $chapterNumber
                    ];
                });

                // Filter out invalid chapters
                $chapters = array_filter($chapters, function ($chapter) {
                    return $chapter['number'] !== null;
                });

                // Further processing of chapters as per your existing logic
            } else {

                // Extract chapter links and numbers
                $chapters = $crawler->filter('#chapterlist li .eph-num a')->each(function ($node) {
                    $text = $node->filter('.chapternum')->text();

                    // Extract the chapter number using regex
                    $chapterNumber = null;
                    if (preg_match('/chapter\s*[\d.]+/i', $text, $matches)) {
                        $chapterNumber = preg_replace('/chapter\s*/i', '', $matches[0]);
                    }

                    return [
                        'url' => $node->attr('href'),
                        'number' => $chapterNumber
                    ];
                });

                // Filter out invalid chapters
                $chapters = array_filter($chapters, function ($chapter) {
                    return $chapter['number'] !== null;
                });
            }
        }
        if (count($chapters) !== Chapter::where('manhwa_id', $manhwa->id)->count()) {
            if ($source == 'tecnoscans') {
                $this->mergeChapters($manhwa, $chapters, $source);
            } else {
                foreach ($chapters as $chapter) {
                    $chapterUrl = $chapter['url'];
                    $chapterNumber = $chapter['number'];
                    // Check if the chapter number is greater than or equal to the starting limit
                    if (floatval($chapterNumber) < $manhwa->starting_limit) {
                        $this->info("{$manhwa->id} Skipping chapter {$chapterNumber} from {$source} due to starting limit.");
                        continue;
                    }

                    // Check if chapter already exists
                    $existingChapter = Chapter::where('manhwa_id', $manhwa->id)
                        ->where('chapter_number', $chapterNumber)
                        ->first();
                    if (!$existingChapter) {
                        $chapter = Chapter::create([
                            'manhwa_id' => $manhwa->id,
                            'chapter_number' => $chapterNumber,
                            'source' => $source,
                            'is_indexed' => false,
                            'link' => $chapterUrl,
                            'wp_chapter_id' => null
                        ]);
                        if ($manhwa->post_id) {
                            WpPostMeta::where('post_id', $manhwa->post_id)->where('meta_key', '_latest_update')->update([
                                'meta_value' => Carbon::now()->timestamp
                            ]);
                            $chapterNumberFormatted = str_replace('.', '-', $chapterNumber);
                            $slug = Str::slug("Chapter " . $chapterNumberFormatted);
                            $chapterData = [
                                "post_id" => $manhwa->post_id,
                                "volume_id" => 0,
                                "chapter_name" => "Chapter " . $chapterNumber,
                                "chapter_name_extend" => "",
                                "chapter_slug" => $slug,
                                "storage_in_use" => "local",
                                "date" => Carbon::now()->format('Y-m-d H:i:s'),
                                "date_gmt" => Carbon::now()->format('Y-m-d H:i:s'),
                                "chapter_index" => 0,
                                "chapter_seo" => null,
                                "chapter_warning" => null,
                                "chapter_status" => 0,
                                "chapter_metas" => ""
                            ];
                            $Wpchapter = WpMangaChapter::create($chapterData);
                            $chapter->wp_chapter_id = $Wpchapter->id;
                            $chapter->save();
                        }
                        Log::info("{$manhwa->id} Added new chapter {$chapterNumber} from {$source}.");
                        $this->info("{$manhwa->id} Added new chapter {$chapterNumber} from {$source}.");
                    }
                }
            }
        } else {
            Log::info("{$manhwa->id} No new chapters found for {$manhwa->name} ({$source}).");
            $this->info("{$manhwa->id} No new chapters found for {$manhwa->name} ({$source}).");
        }
    }
    public function mergeChapters($manhwa, $chapters, $source)
    {
        $mergedChapters = [];

        foreach ($chapters as $chapter) {
            $chapterUrl = $chapter['url'];
            $chapterNumber = $chapter['number'];
            $baseChapterNumber = (int)floor($chapterNumber);
            // $this->info($baseChapterNumber);

            // Skip chapters below the starting limit
            if (floatval($chapterNumber) < $manhwa->starting_limit) {
                $this->info("{$manhwa->id} Skipping chapter {$chapterNumber} from {$source} due to starting limit.");
                continue;
            }

            // Merge URLs by base chapter number
            if (!isset($mergedChapters[$baseChapterNumber])) {
                $mergedChapters[$baseChapterNumber] = [
                    'number' => $baseChapterNumber,
                    'url' => []
                ];
            }

            $mergedChapters[$baseChapterNumber]['url'][] = $chapterUrl;
        }
        $this->info(json_encode($mergedChapters));

        // Process merged chapters
        foreach ($mergedChapters as $chapter) {
            $chapter['url'] = json_encode($chapter['url']);
            $this->info("{$manhwa->id} Processing chapter {$chapter['number']} from {$source}.");

            $existingChapter = Chapter::where('manhwa_id', $manhwa->id)
                ->where('chapter_number', $chapter['number'])
                ->first();
            if (!$existingChapter) {
                Log::info("Adding new chapter {$chapter['number']} from {$source}.");
                $newchapter = Chapter::create([
                    'manhwa_id' => $manhwa->id,
                    'chapter_number' => $chapter['number'],
                    'link' => $chapter['url'],
                    'source' => $source,
                    'is_indexed' => false,

                ]);

                if ($manhwa->post_id) {
                    WpPostMeta::where('post_id', $manhwa->post_id)->where('meta_key', '_latest_update')->update([
                        'meta_value' => Carbon::now()->timestamp
                    ]);
                    $chapterNumberFormatted = str_replace('.', '-', $chapter['number']);
                    $slug = Str::slug("Chapter " . $chapterNumberFormatted);
                    $chapterData = [
                        "post_id" => $manhwa->post_id,
                        "volume_id" => 0,
                        "chapter_name" => "Chapter " . $chapter['number'],
                        "chapter_name_extend" => "",
                        "chapter_slug" => $slug,
                        "storage_in_use" => "local",
                        "date" => Carbon::now()->format('Y-m-d H:i:s'),
                        "date_gmt" => Carbon::now()->format('Y-m-d H:i:s'),
                        "chapter_index" => 0,
                        "chapter_seo" => null,
                        "chapter_warning" => null,
                        "chapter_status" => 0,
                        "chapter_metas" => ""
                    ];
                    $Wpchapter = WpMangaChapter::create($chapterData);
                    $newchapter->wp_chapter_id = $Wpchapter->id;
                    $newchapter->save();
                }
            } else {
                Log::info("{$manhwa->id} Chapter {$chapter['number']} from {$source} already exists.");
            }
        }
    }
}
