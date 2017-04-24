<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfitController extends Controller
{
    public function showProfit()
    {
        $data = Order::with(['item', 'user'])->where('status', 'finished')->get();
        $item = [];
        $item_detail = [];
        foreach ($data as $v) {
            $profit = $v['item']['0']['now_price'] - $v['item']['0']['cost_price'];
            $item_detail[] = [
                'order_id' => $v['order_id'],
                'one_profit' => $profit.'元',
                'total_profit' => $profit * $v['item_number'].'元',
                'item_title' => $v['item_title'],
                'user' => $v['user']['0']['name'],
            ];
        }
        $total_profit = 0;
        $total_number = 0;
        foreach ($item_detail as $i) {
            $total_profit += $i['total_profit'];
            $total_number++;
        }
        $item['data'] = $item_detail;
        $item['total_profit'] = $total_profit;
        $item['total_number'] = $total_number;
        return $item;
    }
}
