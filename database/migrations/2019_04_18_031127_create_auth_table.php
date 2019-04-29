<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->comment('权限名称');
            $table->string('uri', 100)->unique()->comment('权限name');
            $table->string('description', 255)->nullable()->default('')->comment('权限描述');
            $table->timestamps();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->default(0)->comment('上级菜单');
            $table->string('name', 20)->comment('菜单名称');
            $table->string('url', 100)->comment('菜单URL');
            $table->tinyInteger('sort', false, true)->comment('排序');
            $table->string('description', 255)->nullable()->default('')->comment('权限描述');
            $table->timestamps();
        });

        Schema::create('menu_authority', function (Blueprint $table) {
            $table->unsignedInteger('menu_id');
            $table->unsignedInteger('authority_id');

            $table->foreign('menu_id')->references('id')->on('menus')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('authority_id')->references('id')->on('authorities')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['menu_id', 'authority_id']);
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->comment('角色名称');
            $table->string('description', 255)->nullable()->default('')->comment('角色描述');
            $table->timestamps();

        });

        Schema::create('role_menu', function (Blueprint $table) {
            $table->unsignedInteger('menu_id');
            $table->unsignedInteger('role_id');

            $table->foreign('menu_id')->references('id')->on('menus')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['menu_id', 'role_id']);
        });

        Schema::create('role_authority', function (Blueprint $table) {
            $table->unsignedInteger('authority_id');
            $table->unsignedInteger('role_id');

            $table->foreign('authority_id')->references('id')->on('authorities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['authority_id', 'role_id']);
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id')->nullable()->comment('所属角色');
            $table->string('name', 20)->comment('姓名');
            $table->char('phone', 11)->comment('电话号码');
            $table->string('email', 50)->comment('邮件');
            $table->string('password', 60)->comment('密码');
            $table->date('birthday')->default(null)->nullable()->comment('生日');
            $table->date('entryday')->default(null)->nullable()->comment('入职日期');
            $table->enum('sex', ['man', 'women'])->default('man')->comment('性别');
            $table->enum('status', ['on', 'off'])->default('off')->comment('状态');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        DB::statement("ALTER TABLE `authorities` COMMENT '权限表'");
        DB::statement("ALTER TABLE `menus` COMMENT '菜单表'");
        DB::statement("ALTER TABLE `roles` COMMENT '角色表'");
        DB::statement("ALTER TABLE `users` COMMENT '用户表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('role_authority');
        Schema::dropIfExists('role_menu');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('menu_authority');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('authorities');
    }
}
