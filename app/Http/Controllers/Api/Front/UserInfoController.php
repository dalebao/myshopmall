<?php

namespace App\Http\Controllers\Api\Front;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserInfoController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        return UserInfo::select()->where('user_id', $user_id)->first();
    }

    public function store(Request $request)
    {
        $user_id = $request->user()->id;
//        dd($request->tel);
       if (!preg_match('/^((1[3,5,8][0-9])|(14[5,7])|(17[0,1,6,7,8]))\d{8}$/',$request->tel)){
           return response()->json([
               'code' => '400',
               'err_msg' => '手机号码不合法',
           ]);
       }
        try {
            UserInfo::updateOrCreate([
                'user_id' => $user_id
            ], [
                'user_id' => $user_id,
                'tel' => $request->tel,
                'nickname' => $request->nickname
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'err_msg' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'code' => '200',
            'msg' => 'success'
        ]);
    }
}
