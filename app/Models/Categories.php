<?php

namespace App\Models;

use App\Filters\CategoryFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected string $default_filters = CategoryFilters::class;

    protected $table = "categories";

    protected $fillable = ["name"];

    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
