<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Manhwa;
use App\Models\Chapter;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class FetchChapterImages extends Command
{
    protected $signature = 'fetch:chapter-images';
    protected $description = 'Fetch chapter images for newly added chapters';

    protected $httpClient;
    protected $imageManager;

    public function __construct()
    {
        parent::__construct();
        $this->httpClient = new Client();
        $this->imageManager = new ImageManager(new GdDriver()); // Using GD driver
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
        $manhwaFolder = strtolower(str_replace(' ', '-', $manhwa->name));
        $chapterFolder = 'chapter-' . $chapter->chapter_number;
        $baseDirectory = realpath(__DIR__ . '/../../../wordpress/downloads/' . $manhwaFolder . '/' . $chapterFolder);
    
        if ($baseDirectory === false) {
            $baseDirectory = __DIR__ . '/../../../../wordpress/downloads/' . $manhwaFolder . '/' . $chapterFolder;
        }
    
        if (!File::exists($baseDirectory)) {
            File::makeDirectory($baseDirectory, 0755, true);
        }
        
        try {
            $htmlContent = $this->httpClient->get($chapter->link)->getBody()->getContents();
            // Log the HTML content to a file for debugging
            File::put(storage_path('logs/crawl_debug_' . $chapter->id . '.html'), $htmlContent);
    
            $crawler = new \Symfony\Component\DomCrawler\Crawler($htmlContent);
            
         if($chapter->source == 'manhuafast'){
        
            $images = $crawler->filter('.reading-content .page-break img')->each(function ($node) {
                return trim($node->attr('data-src'));
            });
    
         }else{

            $images = $crawler->filter('.reading-content img.wp-manga-chapter-img')->each(function ($node) {
                return trim($node->attr('src'));
            });
    
         }
       
            if (empty($images)) {
                $this->error("No images found for chapter URL: {$chapter->link}");
                return false;
            }
    
            if (count($images) > 20) {
                return $this->combineImages($images, $baseDirectory);
            } else {
                foreach ($images as $index => $imgUrl) {
                    $fileExtension = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $filePath = $baseDirectory . '/image-' . ($index + 1) . '.' . $fileExtension;
    
                    if (!$this->downloadImage($imgUrl, $filePath)) {
                        return false;
                    }
                }
            }
        } catch (\Exception $e) {
            $this->error("Error fetching images from URL: {$chapter->link}. Error: " . $e->getMessage());
            return false;
        }
    
        return true;
    }
    

    protected function combineImages($images, $baseDirectory)
    {
        $chunkedImages = array_chunk($images, 2);

        foreach ($chunkedImages as $index => $chunk) {
            $combinedImagePath = $baseDirectory . '/image-' . ($index + 1) . '.webp';

            if (count($chunk) == 2) {
                $image1 = $this->imageManager->read($this->httpClient->get($chunk[0])->getBody()->getContents());
                $image2 = $this->imageManager->read($this->httpClient->get($chunk[1])->getBody()->getContents());

                $combinedHeight = $image1->height() + $image2->height();
                $combinedWidth = max($image1->width(), $image2->width());

                $combinedImage = $this->imageManager->create($combinedWidth, $combinedHeight);
                $combinedImage->place($image1);
                $combinedImage->place($image2, 'top-left', 0, $image1->height());

                if (!$this->saveImage($combinedImage, $combinedImagePath)) {
                    return false;
                }
            } else {
                if (!$this->downloadImage($chunk[0], $combinedImagePath)) {
                    return false;
                }
            }
        }

        return true;
    }

    protected function downloadImage($url, $path)
    {
        try {
            $response = $this->httpClient->get($url, ['http_errors' => false]);

            if ($response->getStatusCode() === 200) {
                $image = (string) $response->getBody();
                file_put_contents($path, $image);
                $this->info("Downloaded image to: {$path}");
                return true;
            } else {
                $this->error("Failed to download image from URL: {$url}. Status Code: " . $response->getStatusCode());
                return false;
            }
        } catch (\Exception $e) {
            $this->error("Error downloading image from URL: {$url}. Error: " . $e->getMessage());
            return false;
        }
    }

    protected function saveImage($image, $path)
    {
        try {
            $image->toWebp()->save($path);
            $this->info("Saved image to: {$path}");
            return true;
        } catch (\Exception $e) {
            $this->error("Error saving image to path: {$path}. Error: " . $e->getMessage());
            return false;
        }
    }
}
