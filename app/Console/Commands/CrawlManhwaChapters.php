<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Manhwa;
use App\Models\Chapter;
use Illuminate\Support\Facades\File;

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
            $this->info("Checking for new chapters for: {$manhwa->name}");

            // Check Manhuafast
            if (!empty($manhwa->manhwafast_link)) {
                $this->checkChapters($manhwa, $manhwa->manhwafast_link, 'manhuafast');
            } else {
                $this->info("No Manhuafast link for: {$manhwa->name}");
            }

            // Check Manhwaclan
            if (!empty($manhwa->manhwaclan_link)) {
                $this->checkChapters($manhwa, $manhwa->manhwaclan_link, 'manhwaclan');
            } else {
                $this->info("No Manhwaclan link for: {$manhwa->name}");
            }
        }

        $this->info('Crawling completed.');
    }

    protected function checkChapters($manhwa, $url, $source)
    {
        
            // Validate the URL
            if (filter_var($url, FILTER_VALIDATE_URL) === false) {
                $this->error("Invalid URL: {$url}");
                return;
            }
    
            // Determine which script to use based on the source
            $script = $source === 'manhuafast' ? 'fetch_chapters_manhuafast.cjs' : 'fetch_chapters_manhwaclan.cjs';
    
            // Run the Puppeteer script to fetch chapter links
            exec("node scripts/{$script} {$url}", $output, $return_var);
    
            if ($return_var !== 0) {
                $this->error("Failed to fetch chapter links from {$source}.");
                return;
            }
    
            // Determine the correct JSON file based on the source
            $jsonFile = $source === 'manhuafast' ? 'manhuafast_chapters.json' : 'manhwaclan_chapters.json';
    
            // Read the chapter links from the file
            $chapters = json_decode(file_get_contents($jsonFile), true);
    
            if (!$chapters) {
                $this->error("Failed to decode chapters from {$source}.");
                return;
            }
            
        if(count($chapters) !== Chapter::where('manhwa_id',$manhwa->id)->count()) {
        foreach ($chapters as $chapter) {
            $chapterUrl = $chapter['url'];
            $chapterNumber = $chapter['number'];

            // Check if chapter already exists
            $existingChapter = Chapter::where('manhwa_id', $manhwa->id)
                                      ->where('chapter_number', $chapterNumber)
                                      ->first();

            if (!$existingChapter) {
                Chapter::create([
                    'manhwa_id' => $manhwa->id,
                    'chapter_number' => $chapterNumber,
                    'source' => $source,
                    'link' => $chapterUrl
                ]);
                $this->info("Added new chapter {$chapterNumber} from {$source}.");
            }
        }
        } else {
            $this->info("No new chapters found for {$manhwa->name} ({$source}).");
        }
    }
}
