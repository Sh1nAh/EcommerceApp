<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories');
            $table->string('image');
            $table->string('name');
            $table->string('slug');
            $table->string('subtext')->nullable();;
            $table->string('price');
            $table->text('description')->nullable();;
            $table->string('color')->nullable();
            $table->string('icon1')->nullable();;
            $table->string('icon1text')->nullable();;
            $table->string('icon2')->nullable();;
            $table->string('icon2text')->nullable();;
            $table->string('icon3')->nullable();;
            $table->string('icon3text')->nullable();;
            $table->integer('discountpercentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
