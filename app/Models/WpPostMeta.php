<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpPostMeta extends Model
{
    use HasFactory;

    protected $connection = 'wordpress';
    protected $table = 'wp_postmeta';
    public $timestamps = false;

    protected $guarded = ['meta_id'];
}


