<?php

namespace App\Http\Controllers;

use App\Models\Manhwa;
use App\Models\WpPostMeta;
use App\Models\WpPosts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ManhwaController extends Controller
{

  public function index(Request $request)
  {
    $manhwas = Manhwa::withCount('chapters')->orderBy('created_at', 'ASC')->get();
    return view('admin.manhwa.index', compact('manhwas'));
  }

  public function create(Request $request)
  {


    return view('admin.manhwa.create');
  }


  public function store(Request $request)
  {

    try{
      DB::transaction(function () use ($request){
          
        $manhwa =  Manhwa::create($request->all());

        // Create the post without the guid field
        $post = WpPosts::create([
          "post_author" => 1,
          "post_date" => Carbon::now()->format('Y-m-d H:i:s'),
          "post_date_gmt" => Carbon::now()->format('Y-m-d H:i:s'),
          "post_content" => "description",
          "post_title" => $manhwa->name,
          "post_excerpt" => "",
          "post_status" => "publish",
          "comment_status" => "open",
          "ping_status" => "closed",
          "post_password" => "",
          "post_name" => Str::slug($manhwa->name),
          "to_ping" => "",
          "pinged" => "",
          "post_modified" => Carbon::now()->format('Y-m-d H:i:s'),
          "post_modified_gmt" => Carbon::now()->format('Y-m-d H:i:s'),
          "post_content_filtered" => "",
          "post_parent" => 0,
          "menu_order" => 0,
          "post_type" => "wp-manga",
          "post_mime_type" => "",
          "comment_count" => 0,
          "wp_manga_search_text" => $manhwa->name . "|Chapter 1-"
        ]);
    
        // Update the post with the correct guid
        $post->guid = "https://manhwacollection.com/?post_type=wp-manga;p=" . $post->id;
        $post->save();
    
        $manhwa->post_id = $post->id;
        $manhwa->save();
        $this->addPostMetaData($manhwa, $post);
      });


  

    }
    catch(\Exception $e){
      throw($e);
    }

    return redirect()->route('admin.manhwa.index');
  }



  public function addPostMetaData($manhwa, $post)
  {

    // Dynamic values
    $latestUpdateTimestamp = Carbon::now()->timestamp;
    $editLockValue = Carbon::now()->timestamp . ":1";

    // Add post meta data
    $metaData = [
      [
        "post_id" => $post->id,
        "meta_key" => "manga_unique_id",
        "meta_value" => "manga_".$post->id,
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_latest_update",
        "meta_value" => $latestUpdateTimestamp
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "manga_adult_content",
        "meta_value" => ""
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_edit_last",
        "meta_value" => "1"
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_edit_lock",
        "meta_value" => $editLockValue
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_wp_manga_chapter_type",
        "meta_value" => "manga"
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "manga_reading_style",
        "meta_value" => "list"
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "manga_oneshot_image_height",
        "meta_value" => "200"
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "manga_reading_content_gaps",
        "meta_value" => "default"
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "manga_title_badges",
        "meta_value" => "no"
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "manga_custom_badge_link_target",
        "meta_value" => "_self"
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "manga_profile_background",
        "meta_value" => 'a:6:{s:16:"background-color";s:0:"";s:17:"background-repeat";s:0:"";s:21:"background-attachment";s:0:"";s:19:"background-position";s:0:"";s:15:"background-size";s:0:"";s:16:"background-image";s:0:"";}'
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_wp_manga_status",
        "meta_value" => "on-going"
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_wp_manga_alternative",
        "meta_value" => $manhwa->name,
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_wp_manga_chapters_warning",
        "meta_value" => ""
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_wp_manga_type",
        "meta_value" => ""
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_wp_manga_day_views",
        "meta_value" => 'a:2:{s:5:"views";i:1000;s:4:"date";s:2:"30";}'
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_wp_manga_day_views_value",
        "meta_value" => "1000"
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_wp_manga_week_views_value",
        "meta_value" => "1000"
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_wp_manga_month_views",
        "meta_value" => 'a:2:{s:5:"views";i:1000;s:5:"month";s:2:"07";}'
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_wp_manga_month_views_value",
        "meta_value" => "1000"
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_wp_manga_year_views",
        "meta_value" => 'a:2:{s:5:"views";i:1000;s:4:"date";s:2:"24";}'
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_wp_manga_year_views_value",
        "meta_value" => "1000"
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_manga_reviews",
        "meta_value" => 'a:1:{i:1;d:5;}'
      ],
      [
        "post_id" => $post->id,
        "meta_key" => "_manga_total_votes",
        "meta_value" => 1,
      ],
    ];

    foreach ($metaData as $meta) {
      WpPostMeta::create($meta);
    }
  }

  public function edit(Request $request, $id)
  {
    $manhwa = Manhwa::findOrFail($id);

    return view('admin.manhwa.edit', compact('manhwa'));
  }

  public function update(Request $request)
  {
    $data =    $request->all();
    unset($data['_token']);
    isset($data['deep_check']) ? $data['deep_check'] : $data['deep_check'] =false;
    Manhwa::where('id', $request->id)->update($data);

    return redirect()->route('admin.manhwa.index');
  }

  public function delete($id)
  {
    $manhwa = Manhwa::findOrFail($id);
    $manhwa->delete();
    return redirect()->route('admin.manhwa.index');
  }
}
