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
            $table->string("name");
            $table->integer("price")->default(0);
            $table->longText("description");
            $table->integer("status");
            $table->longText("first_thumbnail");
            $table->longText("second_thumbnail");
            $table->longText("main_thumbnail");
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("published_id");
            $table->foreign("category_id")->references("id")->on("categories");
            $table->foreign("published_id")->references("id")->on("users");
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
        Schema::dropIfExists('products');
    }
}
