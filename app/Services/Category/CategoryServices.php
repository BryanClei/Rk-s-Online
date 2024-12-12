<?php

namespace App\Services\Category;

use App\Response\Message;
use App\Models\Categories;
use App\Functions\GlobalFunctions;
use App\Http\Resources\CategoriesResource;

class CategoryServices
{
    public function createCategory(array $data): Categories
    {
        return Categories::create(["name" => $data["name"]]);
    }

    public function updateCategory($category, $name)
    {
        $category->update([
            "name" => $name,
        ]);

        new CategoriesResource($category);

        return GlobalFunctions::display(Message::CATEGORY_UPDATED, $category);
    }

    public function archivedCategory($model)
    {
        if ($model->deleted_at === null) {
            $model->delete();
            $message = Message::CATEGORY_DELETE_TEMPORARY;
        } else {
            $model->restore();
            $message = Message::CATEGORY_RESTORE;
        }

        new CategoriesResource($model);

        return GlobalFunctions::display($message, $model);
    }

    public function deleteCategory($model)
    {
        if ($model->deleted_at !== null) {
            $model->forceDelete();
            return GlobalFunctions::display(Message::CATEGORY_DELETED, $model);
        } else {
            return GlobalFunctions::unProcess(
                Message::CATEGORY_NOT_ON_RECYCLE_BIN,
                $model
            );
        }
    }
}
