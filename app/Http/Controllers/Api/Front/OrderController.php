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
        $page_size = empty($request->page_size) ? 10 : $request->page_size;
        $page = empty($request->page) ? 0 : $request->page;
        if (!empty($number) && !empty($itemId)) {
            $orderId = time() . "_" . $itemId . "_" . $number;
            NewOrder::newOrder($user_id, $itemId, $number, $orderId);
            return User::select()->where('id', $user_id)->with(['userInfo', 'address'])
                ->with(['userOrder' => function ($query) use ($orderId) {
                    $query->where('order_id', $orderId);
                }])->first();
        } else {
            $data = Order::select()->where('status', '!=', 'new')->orderBy('created_at','desc')->skip($page_size * ($page - 1))->paginate($page_size);
            foreach ($data as &$item) {
                //修改订单状态
                if ($item['status'] == 'new') {
                    $item['new_status'] = '未下单';
                };
                if ($item['status'] == 'done') {
                    $item['new_status'] = '已下单，未付款';
                };
                if ($item['status'] == 'cancel') {
                    $item['new_status'] = '订单已取消';
                };
                if ($item['status'] == 'send') {
                    $item['new_status'] = '已发货';
                };
                if ($item['status'] == 'kd_code') {
                    $item['new_status'] = '物流已揽货';
                };
                if ($item['status'] == 'payed') {
                    $item['new_status'] = '订单已支付';
                };
                //修改快递公司
                if ($item['kd_company'] == 'STO') {
                    $item['kd_company'] = '申通快递';
                }
                if ($item['kd_company'] == 'YTO') {
                    $item['kd_company'] = '圆通快递';
                }
                if ($item['kd_company'] == 'SF' || empty($item['kd_company'])) {
                    $item['kd_company'] = '顺丰快递';
                }
                if ($item['kd_company'] == 'SF' || empty($item['kd_company'])) {
                    $item['kd_company'] = '顺丰快递';
                }
                if ($item['kd_company'] == 'HTKY') {
                    $item['kd_company'] = '百世快递';
                }
            }
            return $data;
        }


    }

    public function store(Request $request)
    {
        $order_id = $request->order['order_id'];
        $order_id = explode('：', $order_id);
        try {
            Order::where('order_id', $order_id['1'])->update([
                'status' => 'done',
                'item_number' => $request->order['item_num'],
                'total_price' => $request->order['item_num'] * $request->order['now_price'],
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

    public function destroy($id)
    {
        try {
            Order::where('order_id', $id)->delete();
        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'err_msg' => $e->getMessage(),
            ]);
        }
        return response()->json([
            'code' => '200',
            'msg' => '删除成功',
        ]);
    }

    public function update(Request $request, $id)
    {
        $status = $request->status;
        $now_status = Order::select('status')->where('order_id', $id)->first();
//        echo ($now_status->status); die;
        if ($status == 'payed' && $now_status->status == 'new') {
            return response()->json([
                'code' => 0,
                'err_msg' => '请先下单'
            ]);
        } elseif ($status == 'payed' && $now_status->status == 'cancel') {
            return response()->json([
                'code' => 0,
                'err_msg' => '订单已取消'
            ]);
        } elseif ($status == 'payed' && $now_status->status == 'payed') {
            return response()->json([
                'code' => 0,
                'err_msg' => '订单已支付'
            ]);
        } elseif ($status == 'cancel' && $now_status->status == 'payed') {
            return response()->json([
                'code' => 0,
                'err_msg' => '订单已支付'
            ]);
        } else {
            Order::where('order_id', $id)->update(['status' => $status]);
        }
        return $this->index($request);
    }
}
