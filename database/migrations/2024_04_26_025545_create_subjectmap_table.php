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
        Schema::create('nativesrs', function (Blueprint $table) {
            $table->id();
            $table->string('auth_name');
            $table->integer('auth_srid');
            $table->text('srtext');
            $table->text('proj4text');
            $table->timestamps();
        });

        Schema::create('district', function (Blueprint $table) {
            $table->id();
            $table->string('tenDVHC')->nullable();
            $table->integer('ma_dvhc')->nullable();
            $table->text('ma_dvhc_cha')->nullable();
            $table->text('note')->nullable();
            $table->float('valueX')->nullable();
            $table->float('valueY')->nullable();
            $table->float('zoomm')->nullable();
            // $table->timestamps();
        });

        Schema::create('subjectmap', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('summary')->nullable();
            $table->boolean('is_block')->nullable();
            $table->boolean('is_delete')->nullable();
            $table->text('discription')->nullable();
            $table->integer('year')->nullable();
            $table->float('zoomin')->nullable();
            $table->integer('level')->nullable();
            $table->text('thumbnail')->nullable();
            $table->datetime('create_date')->nullable();
            $table->datetime('active_date')->nullable();
            $table->datetime('expri_date')->nullable();
            $table->integer('number_oder')->nullable();
            $table->text('note')->nullable();
            $table->integer('viewers')->nullable();
            $table->unsignedBigInteger('category_id');
            // $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('district_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('category');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('district_id')->references('id')->on('district');

        });
        Schema::create('systemgeo', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('linkurl')->nullable();
            $table->string('workspace')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->boolean('default')->nullable();
            $table->boolean('is_block')->nullable();
            $table->boolean('is_delete')->nullable();
            $table->integer('number_oder')->nullable();
            $table->timestamps();
        });
        Schema::create('layermap', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('is_block')->nullable();
            $table->boolean('is_delete')->nullable();
            $table->boolean('is_nen')->nullable();
            $table->boolean('default')->nullable();
            $table->string('lable')->nullable();
            $table->integer('number_oder')->nullable();
            $table->unsignedBigInteger('subjectmap_id');
            $table->unsignedBigInteger('systemgeo_id');
            $table->unsignedBigInteger('nativesrs_id');
            $table->timestamps();

            $table->foreign('subjectmap_id')->references('id')->on('subjectmap');
            $table->foreign('systemgeo_id')->references('id')->on('systemgeo');
            $table->foreign('nativesrs_id')->references('id')->on('nativesrs');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {     
        Schema::dropIfExists('nativesrs');
        Schema::dropIfExists('systemgeo');
        Schema::dropIfExists('district');
        Schema::dropIfExists('subjectmap');
        Schema::dropIfExists('layermap');
    }
};
