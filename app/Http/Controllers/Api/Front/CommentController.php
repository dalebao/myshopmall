<?php

namespace App\Http\Controllers\Api\Front;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Exception\RuntimeException;

class CommentController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $user_id = $request->user()->id;
        $item_id = $request->data['item_id'];
        $username = $request->data['name'];
        $nickname = $request->data['nickname'];
        $score = $request->data['score'];
        $comment = $request->data['comment'];
        $is_anonymous = $request->data['is_anonymous'];

        $now_nickname = empty($is_anonymous) ? $nickname : $username;

        try {
            Comment::updateOrCreate([
                'user_id' => $user_id,
                'item_id' => $item_id,
            ], [
                'user_id' => $user_id,
                'item_id' => $item_id,
                'nickname' => $now_nickname,
                'is_anonymous' => $is_anonymous,
                'score' => $score,
                'comment' => $comment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'err_msg' => $e->getMessage(),
            ]);
        }

    }

    public function show($id)
    {
        Comment::select()->where('item_id', $id)->with()->get();
    }

}
