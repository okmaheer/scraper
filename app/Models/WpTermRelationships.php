<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpTermRelationships extends Model
{
    use HasFactory;

    protected $connection = 'wordpress';
    protected $table = 'wp_term_relationships';
    public $timestamps = false;

    protected $fillable = ['object_id', 'term_taxonomy_id','term_order'];
}
