<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Shawn\Kdniao\Kdniao;

class KdController extends Controller
{
    public function getKd(Request $request, $id)
    {

        $order = Order::select('kd_company', 'kd_code')->where('order_id', $id)->first();
        $kd_company = $order['kd_company'];
        $kd_code = $order['kd_code'];

        return \Shawn\Kdniao\Facades\Kdniao::getOrderTraces($kd_company, $kd_code);
    }

}
