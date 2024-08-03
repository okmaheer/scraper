<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Manhwa;
use App\Models\Chapter;
use App\Models\WpMangaChapter;
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
            if (!empty($manhwa->manhwafast_link)) {
                $this->checkChapters($manhwa, $manhwa->manhwafast_link, 'manhuafast');
            } else {
                Log::info("No Manhwaclan link for: {$manhwa->name}");

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
            if($source == 'manhuafast'){
                $script = 'fetch_chapters_manhuafast.cjs';
            }else if($source == 'manhwaclan'){
                $script = 'fetch_chapters_manhwaclan.cjs';

            }else {
                $script = 'fetch_chapters_tecnoscans.cjs';

            }
    
            // Run the Puppeteer script to fetch chapter links
            exec("node scripts/{$script} {$url}", $output, $return_var);
    
            if ($return_var !== 0) {
                Log::info("Failed to fetch chapter links from {$source}.");

                $this->error("Failed to fetch chapter links from {$source}.");
                return;
            }
    
            // Determine the correct JSON file based on the source
            if($source == 'manhwaclan'){
                $jsonFile = 'manhwaclan_chapters.json';
            }else if($source == 'manhuafast'){
                $jsonFile = 'manhuafast_chapters.json';

            }else {
                $jsonFile = 'tecnoscans_chapters.json';

            }
    
            // Read the chapter links from the file
            $chapters = json_decode(file_get_contents($jsonFile), true);
            if (!$chapters) {
                Log::info("Failed to decode chapters from {$source}.");

                $this->error("Failed to decode chapters from {$source}.");
                return;
            }
            
        if(count($chapters) !== Chapter::where('manhwa_id',$manhwa->id)->count()) {
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

            if (!$existingChapter && $existingChapter->chaper_number <  $chapterNumber) {
              $chapter=  Chapter::create([
                    'manhwa_id' => $manhwa->id,
                    'chapter_number' => $chapterNumber,
                    'source' => $source,
                    'link' => $chapterUrl,
                    'wp_chapter_id'=>null
                ]);
                if($manhwa->post_id){

                   $chapterNumberFormatted = str_replace('.', '-', $chapterNumber);
                    $slug = Str::slug("Chapter " . $chapterNumberFormatted);
                    $chapterData = [
                        "post_id" => $manhwa->post_id,
                        "volume_id" => 0,
                        "chapter_name" => "Chapter " .$chapterNumber,
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
                  $Wpchapter=  WpMangaChapter::create($chapterData);
                  $chapter->wp_chapter_id = $Wpchapter->id;
                  $chapter->save();
                }
                Log::info("Added new chapter {$chapterNumber} from {$source}.");

                $this->info("Added new chapter {$chapterNumber} from {$source}.");


            }
        }
        } else {
            Log::info("No new chapters found for {$manhwa->name} ({$source}).");

            $this->info("No new chapters found for {$manhwa->name} ({$source}).");
        }
    }

    
}
