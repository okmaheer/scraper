<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository {
    public function query(Model $model) {
        return $model::query();
    }
}