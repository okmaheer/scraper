<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedChapter extends Model
{
    use HasFactory;
    protected $table = 'deleted_chapters';

    protected $connection = 'mysql';

    protected $guarded = ['id'];

}
