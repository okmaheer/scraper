<?php

namespace App\Console\Commands;

use App\Helper\Helper;
use Illuminate\Console\Command;
use App\Models\Chapter;
use App\Models\ChapterImages;
use App\Models\DeletedChapter;
use App\Models\IndexChapters;
use App\Models\WpMangaChapter;
use App\Models\WpMangaChapterData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckAndDeleteChapter extends Command
{
    protected $signature = 'chapter:check-delete';

    protected $description = 'Check if image exists for chapters, delete chapter if image does not exist';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch all chapters
        $chaptersToDelete = Chapter::where('source', 'tecnoscans')
        // ->where('processed', false)
        ->whereNotIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
                ->from('chapters')
                ->where('source', 'tecnoscans')
                ->groupBy('manhwa_id');
        })
        ->get();
    
    
    foreach ($chaptersToDelete as $chapter) {
        // Delete associated WpMangaChapterData
        $this->info("deleting chapter'.$chapter->chapter_number");
        Log::info('deleting chapter'.$chapter->chapter_number);

        WpMangaChapterData::where('chapter_id', $chapter->wp_chapter_id)->delete();
        
        // Delete associated WpMangaChapter
        WpMangaChapter::where('chapter_id', $chapter->wp_chapter_id)->delete();
    
        // Delete associated ChapterImages
        ChapterImages::where('chapter_id', $chapter->id)->delete();
    
        // Delete associated IndexChapters
        IndexChapters::where('chapter_id', $chapter->id)->delete();
    
        // Finally, delete the chapter itself
        $chapter->delete();
    }
    

        // foreach ($chapters as $chapter) {
        //     $deleteChapter = false;
        //     Log::info("checking chapter  for corrupted Images " . $chapter->chapter_number . " " . $chapter->source . " " . $chapter->manhwa->name);

        //     $this->info("checking chapter for corrupted images " . $chapter->chapter_number . " " . $chapter->source . " " . $chapter->manhwa->name);
            
        //     // Check each image for the chapter
        //     foreach ($chapter->chapterImages as $chapterImage) {

        //         if (!Helper::checkImageUrl($chapterImage->link)) {
        //             $deleteChapter = true;
        //             break; // No need to check further, we can delete this chapter
        //         }
        //     }

        //     // If any image is missing, delete the chapter
        //     if ($deleteChapter) {
        //         DeletedChapter::create([
        //             'chapter_id' => $chapter->id,
        //             'chapter_number' => $chapter->chapter_number,
        //             'wp_chapter_id' => $chapter->wp_chapter_id,
        //             'manhwa_id' => $chapter->manhwa_id,
        //             'reason' => 'One or more images do not exist',
        //         ]);
        //         $chapterId = $chapter->id;
        //         $chapterToDelete = Chapter::where('id',$chapter->id)->first();
        //         WpMangaChapterData::where('chapter_id',$chapterToDelete->wp_chapter_id)->delete();
        //         WpMangaChapter::where('chapter_id',$chapterToDelete->wp_chapter_id)->delete();
        //          ChapterImages::where('chapter_id',$chapterToDelete->id)->delete();
        //          IndexChapters::where('chapter_id',$chapterToDelete->id)->delete();

        //         $chapterToDelete->delete();

        //         Log::info("Deleted chapter with ID: $chapterId because one or more images do not exist.");

        //         $this->info("Deleted chapter with ID: $chapterId because one or more images do not exist.");
        //     }
        // }

      Log::info('Check and delete operation completed.');

        $this->info('Check and delete operation completed.');
    }
}
