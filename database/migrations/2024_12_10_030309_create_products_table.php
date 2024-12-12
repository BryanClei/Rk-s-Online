<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("products", function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->text("description");
            $table->decimal("price", 10, 2);
            $table->integer("quantity");
            $table->string("image")->nullable();
            $table->unsignedInteger("category_id")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign("category_id")
                ->references("id")
                ->on("categories")
                ->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("products");
    }
};
