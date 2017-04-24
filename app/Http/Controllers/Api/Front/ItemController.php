<?php

namespace App\Http\Controllers\Api\Front;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    //fron end index page
    public function index(Request $request)
    {
        $params = $request->all();
        empty($params['page']) ? $params['page'] = 1 : $params['page'];
        empty($params['page_size']) ? $params['page_size'] = 6 : $params['page_size'];

        if (empty($params['cate'])) {
            $category_fa = empty($request->category_fa) ? null : $request->category_fa;
            $category_father = json_encode($category_fa);
            $data = Item::select('id', 'name', 'now_price', 'cate')->where('is_show', '1')
                ->OrderBy(DB::raw('RAND()'))
                ->with('image')
                ->where('cate', 'like', "%" . ($category_father) . "%")
                ->take($params['page_size'])
                ->get();

            foreach ($data as &$item) {
//                dd(isset($item['image']['0']));
                if (empty($item['image']['0'])) {
                    $item['img_url'] = "https://pbs.twimg.com/profile_images/808475349671493632/nvi7WJf4_400x400.jpg";
                } else {
                    $item['img_url'] = "http://shopmall.app/upload/" . $item['image']['0']['url'];
                }
            }
            return $data;
        } else {
            $category = $request->category;
            $where = [];
            if (isset($category)) {
                $where[] = ['cate', 'like', "%" . ($category) . "%"];
            }
            $data = Item::select('id', 'name', 'now_price')->where($where)->OrderBy(DB::raw('RAND()'))->skip($params['page_size'] * ($params['page'] - 1))->paginate($params['page_size']);
            foreach ($data as &$item) {
                if (empty($item['image']['0'])) {
                    $item['img_url'] = "https://pbs.twimg.com/profile_images/808475349671493632/nvi7WJf4_400x400.jpg";
                } else {
                    $item['img_url'] = "http://shopmall.app/upload/" . $item['image']['0']['url'];
                }
            }
            return $data;
        }
    }

    //front end show detail page
    public function show($id, Request $request)
    {
        $data = Item::select()->where('id', $id)->with('image')->first();
        if (empty($data['image']['0'])) {
            $data['img_url'] = 'https://pbs.twimg.com/profile_images/808475349671493632/nvi7WJf4_400x400.jpg';
        } else {
            $data['img_url'] = "http://shopmall.app/upload/" . $data['image']['0']['url'];
        }
        $data['tag'] = json_decode($data['tag']);

        return $data;
    }


}
