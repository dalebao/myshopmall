<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{

    public function index(Request $request)
    {
        dd($request->all());
    }
}
