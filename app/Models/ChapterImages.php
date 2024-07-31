<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterImages extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $guarded = ['id'];


    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

 

}
