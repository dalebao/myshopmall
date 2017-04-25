<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Image;
use App\Repo\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {

        $path = $request->file('img')->store('img');

        return $path;
    }

    public function showImg($id)
    {

        $data = Image::select()->where('item_id', $id)->first();
        $img = [
            'name' => $data['name'],
            'url' => env("APP_URL")."/upload/" . $data['url']
        ];

        return response()->json($img);
    }

}
