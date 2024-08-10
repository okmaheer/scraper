<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefetchManhwa extends Model
{
    use HasFactory;
    protected $connection = 'mysql';

    protected $guarded = ['id'];


    public function manhwa() {
        return $this->belongsTo(Manhwa::class,'id','manhwa_id');
    }
}

