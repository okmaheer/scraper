<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Manhwa;
use App\Models\Chapter;
use App\Models\ChapterImages;
use App\Models\WpMangaChapterData;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class FetchChapterImages extends Command
{
    protected $signature = 'fetch:chapter-images';
    protected $description = 'Fetch chapter images for newly added chapters';

    protected $httpClient;

    public function __construct()
    {
        parent::__construct();
        $this->httpClient = new Client();
    }

    public function handle()
    {
        $chapters = Chapter::where('processed', false)->get();

        foreach ($chapters as $chapter) {
            $manhwa = Manhwa::find($chapter->manhwa_id);
            if (!$manhwa) {
                Log::info("Manhwa not found for chapter ID: {$chapter->id}");

                $this->error("Manhwa not found for chapter ID: {$chapter->id}");
                continue;
            }

            $this->info("Fetching images for {$manhwa->name} - Chapter {$chapter->chapter_number}");
            Log::info("Fetching images for {$manhwa->name} - Chapter {$chapter->chapter_number}");

            $success = $this->fetchImages($manhwa, $chapter);
            
            if ($success) {
                $chapter->processed = true;
                $chapter->save();
            }
        }
        Log::info("Image fetching completed.");

        $this->info('Image fetching completed.');
    }

    protected function fetchImages($manhwa, $chapter)
    {
        try {
            if($chapter->source !== 'tecnoscans'){
            $htmlContent = $this->httpClient->get($chapter->link)->getBody()->getContents();
            $crawler = new \Symfony\Component\DomCrawler\Crawler($htmlContent);
            }

            if($chapter->source == 'manhuafast'){
                $images = $crawler->filter('.reading-content .page-break img')->each(function ($node) {
                    return trim($node->attr('data-src'));
                });
            } else if($chapter->source == 'manhwaclan') {
                $images = $crawler->filter('.reading-content img.wp-manga-chapter-img')->each(function ($node) {
                    return trim($node->attr('src'));
                });
            } 
            else if($chapter->source == 'mgdemon') {
                $images = $crawler->filter('img.imgholder')->each(function ($node) {
                    return trim($node->attr('src'));
                });
            }
            else if($chapter->source == 'asuracomic') {
                $images = $crawler->filter('div.w-full img')->each(function ($node) {
                    $src = trim($node->attr('src'));
                    // Check if the image URL matches the pattern for chapter images
                    if (strpos($src, '/storage/comics/') !== false) {
                        return $src;
                    }
                    return null; // Return null if the image doesn't match the desired pattern
                });
                // Filter out null values and re-index the array
                $images = array_values(array_filter($images, function($value) {
                    return !is_null($value);
                }));
            }
            else if($chapter->source == 'tecnoscans') {
                $images = $this->fetchImagesWithPuppeteer(array_reverse(json_decode($chapter->link)));
            }
            if (empty($images)) {
                Log::info("No images found for chapter URL: {$chapter->link}");

                $this->error("No images found for chapter URL: {$chapter->link}");
                return false;
            }
            $imageData = [];

            foreach ($images as $index => $image){
                ChapterImages::create([
                    'chapter_id' => $chapter->id,
                    'link' => $image,
                    'processed' => 1,

                ]);
                $imageData[$index + 1] = [
                    'src' => $image,
                    'mime' => false // Adjust the mime type as needed
                ];
                Log::info("{$chapter->chapter_number} are downloaded for image URL: {$image}");

                $this->info("{$chapter->chapter_number} are downloaded for image URL: {$image}");

            }
            if($chapter->wp_chapter_id){
                WpMangaChapterData::create([
                    'chapter_id' => $chapter->wp_chapter_id, // Use the appropriate chapter_id
                    'storage' => 'local',
                    'data' => json_encode($imageData)
                ]);


                return true;
            } else {
                return false;
            }
         
            
        } catch (\Exception $e) {
            Log::info("Error fetching images from URL: {$chapter->link}. Error: " . $e->getMessage());
            $this->error("Error fetching images from URL: {$chapter->link}. Error: " . $e->getMessage());
            return false;
        }
    
    }
    protected function fetchImagesWithPuppeteer(array $urls)
    {
        $nodeScript = base_path('scripts/fetchImages.cjs'); // Adjust the path to your Node.js script
        $urlsArg = escapeshellarg(base64_encode(json_encode($urls)));
        $command = "node $nodeScript $urlsArg";
        $output = shell_exec($command);
        $images = json_decode($output, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::info("Failed to parse images from Puppeteer output. Error: " . json_last_error_msg());
            $this->error("Failed to parse images from Puppeteer output. Error: " . json_last_error_msg());
            return [];
        }
    
        return $images;
    }
}
