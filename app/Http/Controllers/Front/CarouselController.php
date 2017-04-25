<?php

namespace App\Http\Controllers\Front;

use App\Models\Carousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarouselController extends Controller
{
    public function index()
    {
        $data = Carousel::all();
        foreach ($data as &$item) {
            $item['item_url'] = "http://www.baoxulong.com/detail/".$item['item_id'];
        }
        return $data;
    }
}