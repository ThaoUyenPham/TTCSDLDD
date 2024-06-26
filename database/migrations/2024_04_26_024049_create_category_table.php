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
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('is_block')->nullable();
            $table->boolean('is_delete')->nullable();
            $table->integer('number_oder')->nullable();
            $table->integer('level')->nullable();
            $table->string('code')->nullable();
            $table->integer('parent_id')->nullable();
            $table->timestamps();
        });
        
        Schema::create('subcategory', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->boolean('is_block')->nullable();
            $table->boolean('is_delete')->nullable();
            $table->integer('number_oder')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
        Schema::dropIfExists('subcategory');
    }
};
