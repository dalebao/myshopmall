<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $page_size = empty($request->page_size) ? 10 : $request->page_size;
        $page = empty($request->page) ? 0 : $request->page;
        $data =  Item::select()->skip($page_size * ($page - 1))->paginate($page_size);
        foreach ($data as &$item){
            if ($item['is_show']){
                $item['is_show'] = true;
            }else{
                $item['is_show'] = true;
            }
        }
        return $data;
    }

    public function destroy($id,Request $request)
    {
        $s = Item::where('id', $id)->delete();
        if ($s) {
            return $this->index($request);
        }else{
            return response()->json([
                'code' => 0,
                'err_msg' => '删除失败'
            ]);
        }
    }

    public function show(Request $request,$id){
        $item = Item::select()->where('id',$id)->first();
        if ($item['is_show']){
            $item['is_show'] = true;
        }else{
            $item['is_show'] = true;
        }
        return $item;
    }

    public function update(Request $request,$id){
        $data = $request->data;
        Item::where('id',$id)->update($data);
    }
}
