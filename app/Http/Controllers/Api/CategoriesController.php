<?php

namespace App\Http\Controllers\Api;

use App\Response\Message;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Helpers\NotFoundHelper;
use App\Functions\GlobalFunctions;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Http\Requests\StatusDisplayRequest;
use App\Services\Category\CategoryServices;
use App\Http\Requests\Categories\StoreRequest;

class CategoriesController extends Controller
{
    protected $categoryServices;

    public function __construct(CategoryServices $categoryServices)
    {
        $this->categoryServices = $categoryServices;
    }

    public function index(StatusDisplayRequest $request)
    {
        $status = $request->input("status");
        $model = Categories::when($status == "inactive", function ($query) {
            $query->onlyTrashed();
        })
            ->useFilters()
            ->dynamicPaginate();

        $response = NotFoundHelper::notFoundData($model);

        if ($response) {
            return $response;
        }

        CategoriesResource::collection($model);

        return GlobalFunctions::display(Message::DATA_DISPLAY, $model);
    }

    public function store(StoreRequest $request)
    {
        $post = $this->categoryServices->createCategory($request->validated());

        $category = new CategoriesResource($post);

        return GlobalFunctions::created(Message::CATEGORY_CREATED, $category);
    }

    public function show(string $id)
    {
        $model = Categories::where("id", $id)->get();

        $response = NotFoundHelper::notFoundData($model);

        if ($response) {
            return $response;
        }

        new CategoriesResource($model);

        return GlobalFunctions::display(Message::DATA_DISPLAY, $model);
    }

    public function update(StoreRequest $request, $id)
    {
        $model = Categories::where("id", $id)
            ->get()
            ->first();

        $response = NotFoundHelper::notFoundData($model);

        if ($response) {
            return $response;
        }

        return $this->categoryServices->updateCategory($model, $request->name);
    }

    public function destroy(string $id)
    {
        $model = Categories::withTrashed()
            ->where("id", $id)
            ->get()
            ->first();
        $response = NotFoundHelper::notFoundData($model);

        if ($response) {
            return $response;
        }

        return $this->categoryServices->archivedCategory($model);
    }

    public function delete(string $id)
    {
        $model = Categories::withTrashed()
            ->where("id", $id)
            ->get()
            ->first();

        $response = NotFoundHelper::notFoundData($model);

        if ($response) {
            return $response;
        }

        return $this->categoryServices->deleteCategory($model);
    }
}
