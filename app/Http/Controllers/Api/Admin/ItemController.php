<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Image;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $page_size = empty($request->page_size) ? 10 : $request->page_size;
        $page = empty($request->page) ? 0 : $request->page;
        $data = Item::select()->skip($page_size * ($page - 1))->paginate($page_size);
        foreach ($data as &$item) {
            if ($item['is_show']) {
                $item['is_show'] = true;
            } else {
                $item['is_show'] = true;
            }
        }
        return $data;
    }

    public function destroy($id, Request $request)
    {
        $s = Item::where('id', $id)->delete();
        if ($s) {
            return $this->index($request);
        } else {
            return response()->json([
                'code' => 0,
                'err_msg' => '删除失败'
            ]);
        }
    }

    public function show(Request $request, $id)
    {
        $item = Item::select()->where('id', $id)->with('image')->first();
        $item['cate'] = json_decode($item['cate']);
        $item['tag'] = json_decode($item['tag']);
        $item['category'] = [$item['cate']->category_fa, $item['cate']->category_son];
        if ($item['is_show']) {
            $item['is_show'] = true;
        } else {
            $item['is_show'] = true;
        }

        return $item;
    }

    public function update(Request $request, $id)
    {
        $name = $request->data['name'];
        $description = $request->data['description'];
        $number = $request->data['number'];
        $now_price = $request->data['now_price'];
        $cost_price = $request->data['cost_price'];
        $category = json_encode($request->data['category']);
        $tag = json_encode($request->data['tag']);
        $is_show = $request->data['recommend'];

        $url = $request->url;
        if (isset($url)) {
            $path_arr = explode('/', $url);
            $url_name = $path_arr['1'];
        }

        try {
            DB::beginTransaction();

            Item::where('id', $id)->update([
                'name' => $name,
                'description' => $description,
                'number' => $number,
                'now_price' => $now_price,
                'cost_price' => $cost_price,
                'cate' => $category,
                'tag' => $tag,
                'is_show' => $is_show
            ]);


            Image::updateOrCreate([
                'url' => $url,
                'item_id' => $id
            ], [
                'url' => $url,
                'name' => $url_name,
                'item_id' => $id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'code' => 0,
                'err_msg' => $e->getMessage(),
            ]);
        }
        DB::commit();

        return response()->json([
            'code' => 200,
            'msg' => 'success'
        ]);

    }

    public function store(Request $request)
    {
        $name = $request->data['name'];
        $description = $request->data['description'];
        $number = $request->data['number'];
        $now_price = $request->data['now_price'];
        $cost_price = $request->data['cost_price'];
        $category = json_encode((empty($request->data['category'])
            ? ['category_fa' => 'mobile', 'category_son' => 'iphone']
            : $request->data['category']));

        $tag = json_encode($request->data['tag']);
        $is_show = $request->data['recommend'];
//        $description = $request->data['description'];
        $url = $request->url;
        if (isset($url)) {
            $path_arr = explode('/', $url);
            $url_name = $path_arr['1'];
        }

        try {
            DB::beginTransaction();
            $new_item_id = Item::updateOrCreate([
                'name' => $name,
            ], [
                'name' => $name,
                'description' => $description,
                'number' => $number,
                'now_price' => $now_price,
                'cost_price' => $cost_price,
                'cate' => $category,
                'tag' => $tag,
                'is_show' => $is_show
            ])->id;

            Image::updateOrCreate([
                'url' => $url,
                'item_id' => $new_item_id
            ], [
                'url' => $url,
                'name' => $url_name,
                'item_id' => $new_item_id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'code' => 0,
                'err_msg' => $e->getMessage(),
            ]);
        }
        DB::commit();
        return response()->json([
            'code' => 200,
            'msg' => 'success'
        ]);
    }
}
