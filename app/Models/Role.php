<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = "roles";

    protected $fillable = [
        "name",
        "access_permission",
    ];

    protected function casts(): array
    {
        return [
            'access_permission' => 'array',
        ];
    }
}
