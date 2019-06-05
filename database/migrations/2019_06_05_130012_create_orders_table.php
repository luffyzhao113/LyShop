<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('member_id')->comment('用户ID');
            $table->string('code', 32)->comment('订单code');
            $table->enum('status', ['unpaid', 'paid', 'shipped', 'sign', 'apply_return', 'returning', 'returned', 'cancel'])->default('unpaid')->comment('订单状态');
            $table->enum('type', ['normal'])->default('normal')->comment('订单类型');
            $table->enum('payment_type', ['normal', 'cash_delivery'])->default('normal')->comment('订单结算类型：normal 正常；cash_delivery 货到付款');
            $table->unsignedInteger('express_id')->nullable()->comment('快递方式');
            $table->string('express_no', 64)->nullable()->comment('快递单号');
            $table->unsignedInteger('pay_id')->nullable()->comment('支付方式');
            $table->string('pay_no', 64)->nullable()->comment('支付单号');
            $table->unsignedInteger('count')->comment('商品总数');
            $table->unsignedInteger('product_total')->comment('商品总价');
            $table->unsignedInteger('order_total')->comment('订单总价');
            $table->unsignedInteger('express_fee')->comment('快递费用');
            $table->unsignedInteger('discount_fee')->comment('优惠费用');
            $table->string('remark', 255)->nullable()->comment('客户备注');
            $table->timestamp('pay_time', 0)->nullable()->comment('支付时间');
            $table->timestamp('deliver_time', 0)->nullable()->comment('发货时间');
            $table->timestamps();
        });

        Schema::create('order_address', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->comment('订单ID');
            $table->string('name', 60)->comment('收货人姓名');
            $table->string('phone', 60)->comment('联系电话');
            $table->string('phone2', 60)->nullable()->comment('备用联系电话');
            $table->string('address', 200)->comment('收货地址');
        });

        Schema::create('order_goods', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->comment('订单ID');
            $table->unsignedBigInteger('goods_id')->comment('商品ID');
            $table->string('name', 100)->comment('商品名称');
            $table->unsignedInteger('price')->default(0)->comment('商品价格');
            $table->unsignedInteger('quantity')->comment('商品数量');
            $table->json('attributes')->nullable()->comment('商品属性');
        });


        Schema::create('order_notes', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->comment('订单ID');
            $table->enum('type', ['other'])->comment('操作类型');
            $table->string('remark', 255)->comment('备注');
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
        Schema::dropIfExists('order_notes');
        Schema::dropIfExists('order_goods');
        Schema::dropIfExists('order_address');
        Schema::dropIfExists('orders');
    }
}
