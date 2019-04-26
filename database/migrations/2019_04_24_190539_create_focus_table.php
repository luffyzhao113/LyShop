<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFocusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('focus_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->comment('焦点图位置名称');
            $table->string('description', 255)->comment('焦点图位置说明');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('focus', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('position_id')->comment('所属焦点图位置');
            $table->string('name', 50)->comment('焦点图名称');
            $table->string('url', 255)->comment('跳转连接');
            $table->string('file', 255)->comment('焦点图文件:图片或者视频');
            $table->string('description', 255)->nullable()->comment('焦点图说明');
            $table->tinyInteger('sort', false, true)->comment('排序');
            $table->enum('status', ['on', 'off'])->comment('状态');
            $table->timestamps();
			$table->softDeletes();
			
            $table->foreign('position_id')->references('id')->on('focus_positions')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('focus');
        Schema::dropIfExists('focus_positions');
    }
}
