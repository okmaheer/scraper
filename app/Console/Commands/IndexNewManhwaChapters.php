<?php

namespace App\Console\Commands;

use App\Models\Manhwa;
use Illuminate\Console\Command;
use App\Models\Manwha;
use App\Services\GoogleIndexingService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class IndexNewManhwaChapters extends Command
{
    protected $signature = 'manwha:index-new-chapters';
    protected $description = 'Indexes newly uploaded manhwa chapters using Google Indexing API';

    protected $googleIndexingService;

    public function __construct(GoogleIndexingService $googleIndexingService)
    {
        parent::__construct();
        $this->googleIndexingService = $googleIndexingService;
    }

    public function handle()
    {
        // Fetch all manhwa
        $manhwaList = Manhwa::all();

        if ($manhwaList->isEmpty()) {
            Log::info('No manhwa found.');

            $this->info('No manhwa found.');
            return;
        }

        foreach ($manhwaList as $manhwa) {
            // Fetch the latest chapter for each manhwa that hasn't been indexed yet
            $chapter = $manhwa->chapters()
                ->where('is_indexed', false)
                ->orderByRaw('CAST(chapter_number AS UNSIGNED) DESC')
                ->first();

            if ($chapter) {
                $chapterNumberFormatted = str_replace('.', '-', $chapter->chapter_number);
                $slug = Str::slug("Chapter " . $chapterNumberFormatted);

                $url = 'https://manhwacollection.com/manga/'.Str::slug($manhwa->name).'/'.$slug;
                $response = $this->googleIndexingService->submitUrl($url);
                if (isset($response['urlNotificationMetadata'])) {
                    // Mark the chapter as indexed
                    $chapter->is_indexed = true;
                    $chapter->save();

                    Log::info("Indexed: " . $url);

                    $this->info("Indexed: " . $url);
                } else {
                    Log::info("Failed to index: " . $url);

                    $this->error("Failed to index: " . $url);
                }
            } else {
                Log::info("No new chapters to index for manhwa: " . $manhwa->name);

                $this->info("No new chapters to index for manhwa: " . $manhwa->name);
            }
        }
    }
}
