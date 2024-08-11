<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\ChapterImages;
use App\Models\Manhwa;
use App\Models\WpMangaChapter;
use App\Models\WpMangaChapterData;
use Illuminate\Http\Request;

class ChapterController extends Controller
{

    public function index(Request $request,$id){
        $chapters = Chapter::where('manhwa_id',$id)->with('manhwa')->orderBy('created_at', 'ASC')->get();
        return view('admin.chapter.index', compact('chapters'));
    }

    public function delete(Request $request,$id){
        $chapter = Chapter::where('id',$id)->first();
        $WpchapterData =WpMangaChapterData::where('chapter_id',$chapter->wp_chapter_id)->delete();
        $Wpchapter =WpMangaChapter::where('chapter_id',$chapter->wp_chapter_id)->delete();
        $chapterImages = ChapterImages::where('chapter_id',$chapter->id)->delete();
        $chapter->delete();
        return redirect()->back();
        
    }
    public function deleteBulk(Request $request,$id){
       $manhwa = Manhwa::where('id',$id)->first();
        $chapters =  Chapter::where('manhwa_id',$manhwa->id)->get();
        foreach($chapters as $chapter){
            $WpchapterData = WpMangaChapterData::where('chapter_id',$chapter->wp_chapter_id)->delete();
            $Wpchapter = WpMangaChapter::where('chapter_id',$chapter->wp_chapter_id)->delete();
            $chapterImages = ChapterImages::where('chapter_id',$chapter->id)->delete();

        }

          Chapter::where('manhwa_id',$manhwa->id)->delete();

          return redirect()->back();

    }

    public function listChapterImages(Request $request,$id){
        $chapterImages = ChapterImages::where('chapter_id',$id)->with('chapter')->orderBy('created_at', 'ASC')->get();
        return view('admin.chapter-images.index', compact('chapterImages'));
    }

    public function deleteChapterImages(Request $request,$id){
        $chapterImages = ChapterImages::where('chapter_id',$id)->with('chapter')->orderBy('created_at', 'ASC')->get();
        return view('admin.chapter-images.index', compact('chapterImages'));
    }


}
