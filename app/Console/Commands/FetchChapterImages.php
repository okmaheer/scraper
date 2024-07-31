<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Manhwa;
use App\Models\Chapter;
use App\Models\ChapterImages;
use App\Models\WpMangaChapterData;
use GuzzleHttp\Client;

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
                $this->error("Manhwa not found for chapter ID: {$chapter->id}");
                continue;
            }

            $this->info("Fetching images for {$manhwa->name} - Chapter {$chapter->chapter_number}");
            
            $success = $this->fetchImages($manhwa, $chapter);
            
            if ($success) {
                $chapter->processed = true;
                $chapter->save();
            }
        }

        $this->info('Image fetching completed.');
    }

    protected function fetchImages($manhwa, $chapter)
    {
        try {
            $htmlContent = $this->httpClient->get($chapter->link)->getBody()->getContents();
            $crawler = new \Symfony\Component\DomCrawler\Crawler($htmlContent);
             
            if($chapter->source == 'manhuafast'){
                $images = $crawler->filter('.reading-content .page-break img')->each(function ($node) {
                    return trim($node->attr('data-src'));
                });
            } else if($chapter->source == 'manhwaclan') {
                $images = $crawler->filter('.reading-content img.wp-manga-chapter-img')->each(function ($node) {
                    return trim($node->attr('src'));
                });
            } else if($chapter->source == 'tecnoscans') {
                $images = $this->fetchImagesWithPuppeteer($chapter->link);
            }
    
            if (empty($images)) {
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
            
                $this->info("{$chapter->chapter_number} are downloaded for image URL: {$image}");

            }
            WpMangaChapterData::create([
                'chapter_id' => $chapter->wp_chapter_id, // Use the appropriate chapter_id
                'storage' => 'local',
                'data' => json_encode($imageData)
            ]);
            
        } catch (\Exception $e) {
            $this->error("Error fetching images from URL: {$chapter->link}. Error: " . $e->getMessage());
            return false;
        }
    
        return true;
    }
    protected function fetchImagesWithPuppeteer($url)
    {
        $nodeScript = base_path('scripts/fetchImages.cjs'); // Adjust the path to your Node.js script

        $command = "node $nodeScript " . escapeshellarg($url);
        $output = shell_exec($command);
        $images = json_decode($output, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error("Failed to parse images from Puppeteer output. Error: " . json_last_error_msg());
            return [];
        }

        return $images;
    }
}
