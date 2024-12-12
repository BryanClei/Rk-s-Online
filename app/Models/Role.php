<?php

namespace App\Models;

use App\Filters\RoleFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, Filterable;

    protected string $default_filters = RoleFilters::class;

    protected $table = "roles";

    protected $fillable = ["name", "access_permission"];

    protected function casts(): array
    {
        return [
            "access_permission" => "array",
        ];
    }
}
