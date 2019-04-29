<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->string('parent_id')->default(0)->comment("父id");
            $table->string('name', 50)->comment('类目名称');
            $table->tinyInteger('sort', false, true)->default(255)->comment('排序');
            $table->text('search_filters')->comment('搜索过滤器');
            $table->string('description', 255)->nullable()->comment('类目说明');
            $table->enum('status', ['on', 'off'])->comment('状态');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
