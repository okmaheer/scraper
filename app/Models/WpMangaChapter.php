<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpMangaChapter extends Model
{
    use HasFactory;

    protected $connection = 'wordpress';
    protected $table = 'wp_manga_chapters';
    public $timestamps = false;

    protected $guarded = ['id'];
}
