<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Image;
use App\Repo\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request){
//        return config('filesystems.disks');
//        $img_name = str_random();
//        $path = Storage::disk('public')->putFile($img_name, $request->file('img'),'public');
//        return Storage::url($img_name).$path;
        $path = $request->file('img')->store('img');

        return $path;
    }

    public function showImg($id){
//        dd(1);
        $data = Image::select()->where('item_id',$id)->first();
        $img = [
            'name'=>$data['name'],
            'url'=>"http:shopmall.app/upload/".$data['url']
        ];
        return response()->json($img);
    }

}
