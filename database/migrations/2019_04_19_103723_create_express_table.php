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
            $table->enum('type', ['piece', 'weigh']);
            $table->string('description', 255)->comment('模板说明');
            $table->enum('view', ['yes', 'no'])->comment('是否接入快递100');
            $table->string('com', 50)->nullable()->default(null)->comment('快递100物流公司编码');
            $table->timestamps();
        });

        Schema::create('express_details', function (Blueprint $table){

        });

        Schema::create('areas', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('parent_id')->comment('父ID');
            $table->tinyInteger('level')->default(0)->comment('层级');
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
        });

        DB::statement("ALTER TABLE `express` COMMENT '快递模板表'");
        DB::statement("ALTER TABLE `express_details` COMMENT '快递模板收费表'");
        DB::statement("ALTER TABLE `areas` COMMENT '中国行政地区表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('express');
    }
}
