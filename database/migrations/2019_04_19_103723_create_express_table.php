<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->comment('模板名称');
            $table->enum('type', ['piece', 'weigh'])->comment('类型');
            $table->string('description', 255)->comment('模板说明');
            $table->enum('status', ['off', 'on'])->comment('状态');
            $table->enum('view', ['yes', 'no'])->comment('是否接入快递100');
            $table->string('com', 50)->nullable()->default(null)->comment('快递100物流公司编码');
            $table->timestamps();
        });

        Schema::create('express_details', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('express_id')->comment('模板ID');
            $table->decimal('first', 10, 3)->comment('首重(首件)：kg');
            $table->decimal('first_fee', 10, 2)->comment('首重(首件)收费：分');
            $table->decimal('continue', 10, 3)->comment('续重(件)：kg');
            $table->decimal('continue_fee', 10, 2)->comment('续重(件)收费：分');
            $table->timestamps();

            $table->foreign('express_id')->references('id')->on('express')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('areas', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('parent_id')->comment('父ID');
            $table->tinyInteger('level', false, true)->default(0)->comment('层级');
            $table->string('area_code', 12)->default('0')->comment('行政代码');
            $table->char('zip_code', 6)->default('000000')->comment('邮编');
            $table->char('city_code', 6)->default('')->comment('区号');
            $table->string('name', 50)->comment('名称');
            $table->string('short_name', 50)->comment('简称');
            $table->string('merger_name', 50)->comment('组合名');
            $table->string('pinyin', 50)->comment('拼音');
            $table->decimal('lng', 10, 6)->default('0.000000')->comment('经度');
            $table->decimal('lat', 10, 6)->default('0.000000')->comment('维度');
            $table->index(['level', 'parent_id']);
            $table->engine = 'MyISAM';
        });

        Schema::create('express_detail_areas', function (Blueprint $table){
            $table->unsignedInteger('area_id')->comment('地区ID');
            $table->unsignedInteger('express_detail_id')->comment('记件id');
            $table->enum('type', ['piece', 'weigh']);
            $table->primary(['area_id', 'express_detail_id']);

            $table->foreign('express_detail_id')->references('id')->on('express_details')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('type')->references('type')->on('express')
                ->onUpdate('restrict')->onDelete('cascade');
        });


        DB::statement("ALTER TABLE `express` COMMENT '快递模板表'");
        DB::statement("ALTER TABLE `express_details` COMMENT '计重收费表'");
        DB::statement("ALTER TABLE `express_detail_areas` COMMENT '计重(件)地区关联表'");
        DB::statement("ALTER TABLE `areas` COMMENT '中国行政地区表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('express_detail_areas');
        Schema::dropIfExists('express_details');
        Schema::dropIfExists('areas');
        Schema::dropIfExists('express');
    }
}
