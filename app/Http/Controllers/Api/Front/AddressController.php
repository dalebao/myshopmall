<?php

namespace App\Http\Controllers\Api\Front;

use App\Models\Address;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->address()->first();
    }

    public function store(Request $request)
    {
        $user_id = $request->user()->id;
        try {
            Address::updateOrCreate(
                ['user_id' => $user_ids],
                ['user_id' => $user_id,
                    'province' => $request->province,
                    'city' => $request->city,
                    'detail' => $request->detail
                ]);
        } catch (\Exception $e) {
            return response()->json([
                'err_code' => $e->getCode(),
                'err_msg' => $e->getMessage()
            ]);
        }

        return response()->json([
            'code' => '200',
            'msg' => 'success'
        ]);
    }
}
