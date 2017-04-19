<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $page_size = empty($request->page_size) ? 10 : $request->page_size;
        $page = empty($request->page) ? 0 : $request->page;
        $data = Order::with('user')->with('address')->where('status', '<>', 'new')->skip($page_size * ($page - 1))->paginate($page_size);
        foreach ($data as &$item) {
            $item['address']['0']['address'] = $item['address']['0']['province'] . "/" . $item['address']['0']['city'] . "/" . $item['address']['0']['detail'];
            //修改订单状态
            if ($item['status'] == 'new') {
                $item['new_status'] = '未下单';
            };
            if ($item['status'] == 'send') {
                $item['new_status'] = '已发货';
            };
            if ($item['status'] == 'done') {
                $item['new_status'] = '已下单，未付款';
            };
            if ($item['status'] == 'cancel') {
                $item['new_status'] = '订单已取消';
            };
            if ($item['status'] == 'kd_code') {
                $item['new_status'] = '等待发货';
            };
            if ($item['status'] == 'payed') {
                $item['new_status'] = '订单已支付';
            };
            //修改快递公司
            if ($item['kd_company'] == 'CTO') {
                $item['kd_company'] = '申通快递';
            }
            if ($item['kd_company'] == 'YTO') {
                $item['kd_company'] = '圆通快递';
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
        $now_status = Order::select('status', 'kd_code')->where('order_id', $id)->first();
        $kd_code = empty($request->kd_code) ? $now_status->kd_code : $request->kd_code;

//        dd($now_status->kd_code);
//        echo ($now_status->status); die;
        if ($status == 'send' && $now_status->status == 'new') {
            return response()->json([
                'code' => 0,
                'err_msg' => '用户未下单'
            ]);
        } elseif ($status == 'send' && $now_status->status == 'cancel') {
            return response()->json([
                'code' => 0,
                'err_msg' => '订单已取消'
            ]);
        } elseif ($status == 'send' && $now_status->status == 'send') {
            return response()->json([
                'code' => 0,
                'err_msg' => '请勿重复发货'
            ]);
        } elseif ($status == 'send' && empty($now_status->kd_code)) {
            return response()->json([
                'code' => 0,
                'err_msg' => '未填写快递单号'
            ]);
        } elseif ($status == 'kd_code' && $now_status->status == 'cancel') {
            return response()->json([
                'code' => 0,
                'err_msg' => '订单已取消'
            ]);
        } elseif ($status == 'kd_code' && $now_status->status == 'done') {
            return response()->json([
                'code' => 0,
                'err_msg' => '订单未付款'
            ]);
        } else {
            Order::where('order_id', $id)->update(['status' => $status, 'kd_code' => $kd_code]);
        }

        return $this->index($request);
    }

//new->done-->payed->kd_code->send
}
