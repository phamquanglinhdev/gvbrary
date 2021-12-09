<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("owner_id");
            $table->unsignedBigInteger("order_id")->nullable();
            $table->date("expiry");
            $table->integer("status");
            $table->foreign("product_id")->references("id")->on("products");
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("order_id")->references("id")->on("orders");
            $table->foreign("owner_id")->references("id")->on("users");
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
        Schema::dropIfExists('requests');
    }
}
