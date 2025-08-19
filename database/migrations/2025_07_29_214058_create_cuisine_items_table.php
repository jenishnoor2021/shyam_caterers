<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuisineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuisine_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cuisine_category_id')->unsigned()->index();
            $table->string('item_name');
            $table->string('file')->nullable();
            $table->string('priority')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('cuisine_category_id')->references('id')->on('cuisine_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuisine_items');
    }
}
