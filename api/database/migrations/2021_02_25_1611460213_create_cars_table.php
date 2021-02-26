<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {

            $table->bigIncrements('id')->length(20);
            $table->bigInteger('brand_id')->length(20);
            $table->string('model',50);
            $table->string('color',32)->nullable();
            $table->decimal('engine', 10,2)->nullable();
            $table->char('year_of_manufacture')->length(4);
            $table->index(['brand_id', 'created_at']);
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
