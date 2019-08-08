<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('商品名称');
            $table->string('file', 255)->comment('商品主图');
            $table->unsignedInteger('price')->default(0)->comment('商品价格');
            $table->unsignedInteger('stock')->default(0)->comment('商品库存');
            $table->unsignedInteger('weight')->default(0)->comment('重量');
            $table->enum('type', ['normal', 'group', 'seckill'])->comment('商品类型:正常,团购,秒杀');
            $table->enum('status', ['grounding', 'undercarriage'])->comment('商品状态：上架，下架');
            $table->unsignedInteger('view')->default(0)->comment('查看次数');
            $table->unsignedInteger('sales')->default(0)->comment('销量');
            $table->unsignedInteger('collect')->default(0)->comment('收藏次数');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('goods_categories', function (Blueprint $table) {
            $table->unsignedInteger('goods_id');
            $table->string('category_id', 20);

            $table->foreign('goods_id')->references('id')->on('goods')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['goods_id', 'category_id']);
        });

        Schema::create('goods_galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('goods_id')->comment('商品ID');
            $table->string('file')->comment('图片地址');
            $table->tinyInteger('sort', false, true)->default(0)->comment('排序');
            $table->timestamps();
            $table->foreign('goods_id')->references('id')->on('goods')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('goods_specs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('goods_id')->comment('商品ID');
            $table->unsignedInteger('price')->comment('价格');
            $table->unsignedInteger('stock')->comment('库存');
            $table->string('file', 255)->nullable()->comment('附件[图片]');
            $table->timestamps();
            $table->foreign('goods_id')->references('id')->on('goods')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('goods_spec_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('goods_id')->comment('商品ID');
            $table->unsignedInteger('goods_spec_id')->comment('商品规格价格和库存');
            $table->string('name', 20)->comment('规格名称');
            $table->string('value', 20)->comment('规格值');

            $table->foreign('goods_id')->references('id')->on('goods')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('goods_spec_id')->references('id')->on('goods_specs')
                ->onUpdate('cascade')->onDelete('cascade');
        });


        Schema::create('goods_details', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('goods_id')->comment('商品ID');
            $table->text('describe')->nullable()->comment('商品描述');
            $table->string('unit', 10)->comment('单位');
            $table->timestamps();

            $table->foreign('goods_id')->references('id')->on('goods')
                ->onUpdate('cascade')->onDelete('cascade');
        });


        Schema::create('goods_attributes', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('goods_id')->comment('商品ID');
            $table->string('name', 20)->comment('规格名称');
            $table->string('values', 255)->comment('规格值');
            $table->timestamps();

            $table->foreign('goods_id')->references('id')->on('goods')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        // 商品快递模板
        Schema::create('goods_express', function (Blueprint $table){
            $table->unsignedInteger('goods_id')->comment('商品ID');
            $table->unsignedInteger('express_id')->comment('快递模板ID');
            $table->foreign('goods_id')->references('id')->on('goods')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('express_id')->references('id')->on('express')
                ->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_categories');
        Schema::dropIfExists('goods_attributes');
        Schema::dropIfExists('goods_galleries');
        Schema::dropIfExists('goods_spec_items');
        Schema::dropIfExists('goods_specs');
        Schema::dropIfExists('goods_details');
        Schema::dropIfExists('goods');
    }
}
