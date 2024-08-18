<?php

namespace App\Http\Controllers;

use App\Models\IndexChapters;
use Illuminate\Http\Request;

class IndexChapterContoller extends Controller
{
    
  public function index(Request $request)
  {
    $chapters = IndexChapters::with('chapter')->get();
    return view('admin.chapter-index.index', compact('chapters'));
  }
}
