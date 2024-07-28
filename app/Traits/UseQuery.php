<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait UseQuery {
    public function query(Model $model) {
        return $model::query();
    }
}