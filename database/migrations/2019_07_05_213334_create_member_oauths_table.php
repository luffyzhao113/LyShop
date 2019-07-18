<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberOauthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'member_oauths',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('member_id')->comment('用户ID');
                $table->enum('type', ['wxapp'])->comment('类型');
                $table->string('openid', 100)->comment('在第三方平台上用户唯一标识');
                $table->string('token', 100)->comment('访问第三方平台数据的令牌');
                $table->string('refresh_token', 100)->comment('令牌过期后刷新令牌用的令牌');
                $table->integer('token_exp')->comment('令牌刷新时间');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_oauths');
    }
}
