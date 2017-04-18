<?php

namespace App\Http\Controllers\Api\Front;

use App\Models\Order;
use App\Repo\NewOrder;
//use App\Repo\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $number = $request->item_number;
        $itemId = $request->item_id;
        $orderId = time() . "_" . $itemId . "_" . $number;

        NewOrder::newOrder($user_id, $itemId, $number, $orderId);

        return User::select()->where('id', $user_id)->with(['userInfo', 'address'])
            ->with(['userOrder' => function ($query) use ($orderId) {
                $query->where('order_id', $orderId);
            }])->first();
    }

    public function store(Request $request)
    {
        $order_id = $request->order['order_id'];
        $order_id=explode('：',$order_id);
        try {
        Order::where('order_id', $order_id['1'])->update([
            'status' => 'done',
            'item_number' => $request->order['item_num'],
            'total_price' => $request->order['item_num']*$request->order['now_price'],
            'kd_company' => $request->order['kd_company'],
        ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'err_msg' => $e->getMessage(),
            ]);
        }
        return response()->json([
            'code' => '200',
            'msg' => 'success',
        ]);
    }
}
