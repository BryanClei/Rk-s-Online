<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class NotFoundHelper {
    public static function notFoundData($model){

        if (empty($model) || ($model instanceof Collection && $model->isEmpty())) {
            return response()->json(['message' => 'Data not found.'], 404);
        }

    }
}