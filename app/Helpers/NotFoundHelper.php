<?php

namespace App\Helpers;

use App\Response\Message;
use App\Functions\GlobalFunctions;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NotFoundHelper
{
    public static function notFoundData($model)
    {
        if (empty($model)) {
            return GlobalFunctions::notFound(Message::NO_DATA_FOUND);
        }

        if ($model instanceof LengthAwarePaginator && $model->total() === 0) {
            return GlobalFunctions::notFound(Message::NO_DATA_TO_DISPLAY);
        }

        if ($model instanceof Collection && $model->isEmpty()) {
            return GlobalFunctions::notFound(Message::NO_DATA_TO_DISPLAY);
        }

        return null;
    }
}
