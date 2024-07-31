<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpPosts extends Model
{
    use HasFactory;
    protected $connection = 'wordpress';
    protected $table = 'wp_posts';
    public $timestamps = false;

    protected $guarded = ['id'];



}
