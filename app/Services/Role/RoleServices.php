<?php

namespace App\Services\Role;

use App\Models\Role;

class RoleServices
{
    public function createRole(array $data): Role
    {
        return Role::create([
            "name" => $data["name"],
            "access_permission" => $data["access_permission"] ?? "",
        ]);
    }
}
