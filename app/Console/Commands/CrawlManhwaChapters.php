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
use PDO;

class CrawlManhwaChapters extends Command
{
    protected $signature = 'crawl:manhwa-chapters';
    protected $description = 'Crawl for new manhwa chapters and update the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $manhwas = Manhwa::all();
        foreach ($manhwas as $manhwa) {
            Log::info("Checking for new chapters for: {$manhwa->name}");
            $this->info("Checking for new chapters for: {$manhwa->name}");

            // Check Manhwaclan
            if (!empty($manhwa->manhwaclan_link)) {
                $this->checkChapters($manhwa, $manhwa->manhwaclan_link, 'manhwaclan');
            } else {
                Log::info("No Manhwaclan link for: {$manhwa->name}");
                $this->info("No Manhwaclan link for: {$manhwa->name}");
            }
               // Check Manhuafast
               if (!empty($manhwa->asuracomic_link)) {
                $this->checkChapters($manhwa, $manhwa->asuracomic_link, 'asuracomic');
            } else {
                Log::info("No Asuracomic link for: {$manhwa->name}");
                $this->info("No Asuracomic link for: {$manhwa->name}");
            }
               // Check Manhuafast
               if (!empty($manhwa->mgdemon_link)) {
                $this->checkChapters($manhwa, $manhwa->mgdemon_link, 'mgdemon');
            } else {
                Log::info("No MGdemon link for: {$manhwa->name}");
                $this->info("No MGdemon link for: {$manhwa->name}");
            }
            // Check Manhuafast
            if (!empty($manhwa->manhwafast_link)) {
                $this->checkChapters($manhwa, $manhwa->manhwafast_link, 'manhuafast');
            } else {
                Log::info("No Manhuafast link for: {$manhwa->name}");
                $this->info("No Manhuafast link for: {$manhwa->name}");
            }


            if (!empty($manhwa->tecnoscans_link)) {
                $this->checkChapters($manhwa, $manhwa->tecnoscans_link, 'tecnoscans');
            } else {
                Log::info("No Manhwaclan link for: {$manhwa->name}");

                $this->info("No Manhwaclan link for: {$manhwa->name}");
            }
        }

        Log::info("Crawling completed.");
        $this->info('Crawling completed.');
    }

    protected function checkChapters($manhwa, $url, $source)
    {
        // Validate the URL
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            Log::info("Invalid URL: {$url}");
            $this->error("Invalid URL: {$url}");
            return;
        }

        // Determine which script to use based on the source
        if ($source == 'manhuafast') {
            $script = 'fetch_chapters_manhuafast.cjs';
        } else if ($source == 'manhwaclan') {
            $script = 'fetch_chapters_manhwaclan.cjs';
        } else if($source == 'mgdemon') {
            $script = 'fetch_chapters_mgdemon.cjs';
            }
        elseif($source == 'asuracomic') {
            $script = 'fetch_chapters_asuracomic.cjs';
            }
            else {
            $script = 'fetch_chapters_tecnoscans.cjs';
        }
        // Log the command being executed
        $command = "node scripts/{$script} {$url} 2>&1";
        Log::info("Executing command: {$command}");

        // Execute the command and capture output
        $output = shell_exec($command);
        if ($output === null) {
            Log::error("Failed to execute script for {$source}");
            $this->error("Failed to execute script for {$source}");
            return;
        }
        
        // Log::info("Raw output from script: {$output}");

        // Decode the output
        $chapters = json_decode($output, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error("Failed to decode chapters from {$source}. Error: " . json_last_error_msg());
            $this->error("Failed to decode chapters from {$source}. Error: " . json_last_error_msg());
            $this->error($output);  // Show the raw output for debugging
            return;
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
                    $this->info("Skipping chapter {$chapterNumber} from {$source} due to starting limit.");
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
                    Log::info("Added new chapter {$chapterNumber} from {$source}.");
                    $this->info("Added new chapter {$chapterNumber} from {$source}.");
                }
            }
            }
        } else {
            Log::info("No new chapters found for {$manhwa->name} ({$source}).");
            $this->info("No new chapters found for {$manhwa->name} ({$source}).");
        }
    
    }
    public function mergeChapters($manhwa, $chapters, $source)
    {
        $mergedChapters = [];

        foreach ($chapters as $chapter) {
            $chapterUrl = $chapter['url'];
            $chapterNumber = $chapter['number'];
            $baseChapterNumber = (int)floor($chapterNumber);

            // Skip chapters below the starting limit
            if (floatval($chapterNumber) < $manhwa->starting_limit) {
                $this->info("Skipping chapter {$chapterNumber} from {$source} due to starting limit.");
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

        // Process merged chapters
        foreach ($mergedChapters as $chapter) {
            $chapter['url'] = json_encode($chapter['url']);
            $this->info("Processing chapter {$chapter['number']} from {$source}.");

            $existingChapter = Chapter::where('manhwa_id', $manhwa->id)
                ->where('chapter_number', $chapter['number'])
                ->first();
                if (!$existingChapter) {
                Log::info("Adding new chapter {$chapter['number']} from {$source}.");
                $newchapter = Chapter::create([
                    'manhwa_id' => $manhwa->id,
                    'chapter_number' => $chapter['number'],
                    'link' => $chapter['url'],
                    'source' => $source
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
                Log::info("Chapter {$chapter['number']} from {$source} already exists.");
            }
        }
    }
}
