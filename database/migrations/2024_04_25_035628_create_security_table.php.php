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
        Schema::create('security', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->integer('number_oder')->nullable();
            $table->boolean('is_block')->nullable();
            $table->datetime('active_date')->nullable();
            $table->datetime('expri_date')->nullable();
            $table->boolean('is_delete')->nullable();
            $table->timestamps();
        });
        Schema::create('listpermission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('security_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('security_id')->references('id')->on('security');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security');
        Schema::dropIfExists('listpermission');
        //
    }
};
