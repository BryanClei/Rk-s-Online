<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "products";

    protected $fillable = [
        "name",
        "description",
        "price",
        "quantity",
        "image",
        "category_id",
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
