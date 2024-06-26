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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('is_block')->nullable();
            $table->boolean('is_delete')->nullable();
            $table->integer('number_oder')->nullable();
            $table->integer('level')->nullable();
            $table->text('link')->nullable();
            $table->text('thumbnail')->nullable();
            $table->string('code')->nullable();
            $table->datetime('create_date')->nullable();
            $table->datetime('active_date')->nullable();
            $table->datetime('expire_date')->nullable();
            // $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('topads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('describe')->nullable();
            $table->boolean('is_delete')->nullable();
            $table->boolean('is_block')->nullable();
            $table->integer('level')->nullable();
            $table->integer('number_oder')->nullable();
            $table->datetime('create_date')->nullable();
            $table->datetime('active_date')->nullable();
            $table->datetime('expire_date')->nullable();
            // $table->unsignedBigInteger('user_id');
            $table->timestamps();
            
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
        Schema::dropIfExists('topads');
    }
};
