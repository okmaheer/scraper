<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpMangaChapterData extends Model
{
    use HasFactory;

    protected $connection = 'wordpress';
    protected $table = 'wp_manga_chapters_data';
    public $timestamps = false;

    protected $guarded = ['data_id'];
}
