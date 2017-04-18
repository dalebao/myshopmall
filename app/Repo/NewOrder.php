<?php
/**
 * Created by PhpStorm.
 * User: baoxulong
 * Date: 2017/4/14
 * Time: 11:36
 */

namespace App\Repo;

use App\Models\Item;
use App\Models\Order;

class NewOrder
{
    public static function newOrder($userId, $itemId, $itemNum, $order_id)
    {
        $result = Item::select('id', 'name','now_price')->where('id', $itemId)->first();
//        dd($result);
        return Order::updateOrCreate([
            'order_id' => $order_id
        ], [
            'user_id' => $userId,
            'item_id' => $itemId,
            'total_price' => $itemNum * $result->now_price,
            'item_number' => $itemNum,
            'item_title' => $result->name,
            'status' => 'new',
            'order_id' => $order_id
        ]);
    }
}