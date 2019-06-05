<?php


namespace App\Http\Controllers\Api\Order;


use App\Http\Controllers\Controller;
use App\Repositories\Order;

class OrderController extends Controller
{
    /**
     * @var Order
     * @author luffyzhao@vip.126.com
     */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}