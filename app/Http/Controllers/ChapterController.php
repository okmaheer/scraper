<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\ChapterImages;
use App\Models\IndexChapters;
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
        $chapterImages = IndexChapters::where('chapter_id',$chapter->id)->delete();

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
            $chapterImages = IndexChapters::where('chapter_id',$chapter->id)->delete();


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


    public function create(Request $request){
        $manhwas =Manhwa::orderBy('name', 'ASC')->get();
        return view('admin.chapter.create', compact('manhwas'));
    }


    // public function store(Request $request)
    // {
    //     $manhwa = Manhwa::first($request->manhwa_id);
    //     // Validate the incoming request data
    //     $chapter = Chapter::create([
    //         'manhwa_id' => $manhwa->id,
    //         'chapter_number' => $request->chapter_number,
    //         'source' => $request->source,
    //         'link' => $request->link,
    //         'wp_chapter_id' => null
    //     ]);
    //     if ($manhwa->post_id) {
    //         WpPostMeta::where('post_id', $manhwa->post_id)->where('meta_key', '_latest_update')->update([
    //             'meta_value' => Carbon::now()->timestamp
    //         ]);
    //         $chapterNumberFormatted = str_replace('.', '-', $chapterNumber);
    //         $slug = Str::slug("Chapter " . $chapterNumberFormatted);
    //         $chapterData = [
    //             "post_id" => $manhwa->post_id,
    //             "volume_id" => 0,
    //             "chapter_name" => "Chapter " . $chapterNumber,
    //             "chapter_name_extend" => "",
    //             "chapter_slug" => $slug,
    //             "storage_in_use" => "local",
    //             "date" => Carbon::now()->format('Y-m-d H:i:s'),
    //             "date_gmt" => Carbon::now()->format('Y-m-d H:i:s'),
    //             "chapter_index" => 0,
    //             "chapter_seo" => null,
    //             "chapter_warning" => null,
    //             "chapter_status" => 0,
    //             "chapter_metas" => ""
    //         ];
    //         $Wpchapter = WpMangaChapter::create($chapterData);
    //         $chapter->wp_chapter_id = $Wpchapter->id;
    //         $chapter->save();
    
    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Chapter added successfully.');
    // }
    


}
