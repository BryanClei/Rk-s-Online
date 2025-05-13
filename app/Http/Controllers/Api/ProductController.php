<?php

namespace App\Http\Controllers\Api;

use App\Models\Products;
use App\Response\Message;
use Illuminate\Http\Request;
use App\Helpers\NotFoundHelper;
use App\Functions\GlobalFunctions;
use App\Http\Controllers\Controller;
use App\Services\Products\ProductService;
use App\Http\Requests\StatusDisplayRequest;
use App\Http\Resources\Products\ProductsResource;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(StatusDisplayRequest $request)
    {
        $status = $request->input("status");

        $model = Products::get();

        $response = NotFoundHelper::notFoundData($model);

        if ($response) {
            return $response;
        }

        ProductsResource::collection($model);

        return GlobalFunctions::responseFunction(Message::DATA_DISPLAY, $model);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
