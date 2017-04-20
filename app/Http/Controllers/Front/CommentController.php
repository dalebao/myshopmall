<?php

namespace App\Http\Controllers\Front;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function show($item_id)
    {
        $data = Comment::select()->where('item_id', $item_id)->get();

        return $data;
    }

}
