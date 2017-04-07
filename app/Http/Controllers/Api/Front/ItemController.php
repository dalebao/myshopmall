<?php

namespace App\Http\Controllers\Api\Front;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    //fron end index page
    public function index(Request $request)
    {
        $params = $request->all();
        empty($params['page']) ? $params['page'] = 1 : $params['page'];
        empty($params['page_size']) ? $params['page_size'] = 6 : $params['page_size'];


        if (empty($params['cate'])) {
            return Item::select('id', 'name', 'now_price')->where('is_show', '1')->take($params['page_size'])->get();
        } else {
            return Item::select('id', 'name', 'now_price')->skip($params['page_size'] * ($params['page'] - 1))->paginate($params['page_size']);
        }
    }

    //front end show detail page
    public function show($id, Request $request)
    {
        return Item::select()->where('id', $id)->first();
    }


}
