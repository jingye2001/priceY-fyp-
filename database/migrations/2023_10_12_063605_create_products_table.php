<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('price');
            $table->string('brand');
            $table->string('cpu');
            $table->string('chipset');
            $table->string('gpu');
            $table->string('memory');
            $table->string('battery');
            $table->string('display_type');
            $table->string('display_size');
            $table->string('body_dimension');
            $table->string('body_weight');
            $table->string('body_type');
            $table->string('rear_camera');
            $table->string('front_camera');
            $table->string('video');
            $table->string('camera_features');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
