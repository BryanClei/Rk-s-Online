<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Response\Message;
use Illuminate\Http\Request;
use App\Helpers\NotFoundHelper;
use App\Functions\GlobalFunctions;
use App\Services\Role\RoleServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Requests\Role\StoreRequest;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleServices $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $model = Role::useFilters()->dynamicPaginate();

        $response = NotFoundHelper::notFoundData($model);

        if ($response) {
            return $response;
        }

        RoleResource::collection($model);

        return GlobalFunctions::display(Message::DATA_DISPLAY, $model);
    }

    public function store(StoreRequest $request)
    {
        $model = $this->roleService->createRole($request->validated());

        $role = new RoleResource($model);

        return GlobalFunctions::created(Message::ROLE_CREATED, $role);
    }
}
