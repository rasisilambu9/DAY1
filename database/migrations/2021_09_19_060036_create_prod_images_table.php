<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_images', function (Blueprint $table) {
            $table->id();
            $table->text('pic');
            $table->binary('image2')->nullable();
            $table->binary('image3')->nullable();
            $table->binary('image4')->nullable();
            $table->binary('image5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod_images');
    }
}
