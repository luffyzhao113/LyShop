<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('goods_id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->string('name', 100)->comment('商品名称');
            $table->unsignedInteger('quantity')->comment('商品数量');
            $table->unsignedInteger('price')->default(0)->comment('商品单价');
            $table->json('attributes')->comment('商品属性');
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
        Schema::dropIfExists('carts');
    }
}
