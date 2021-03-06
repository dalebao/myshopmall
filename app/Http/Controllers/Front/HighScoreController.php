<?php

namespace App\Http\Controllers\Front;

use App\Models\Comment;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HighScoreController extends Controller
{
    public function index()
    {
        $highScore = $this->getHighScore();
        $item_id = $this->scoreFunc($highScore);
//        dd($highScore);
        $data = [];
        $item = Item::select()->whereIn('id', $item_id)->get();
        foreach ($item as $value) {
            $data[] = [
                'name' => $value['name'],
                'url' => 'http://shopmall.app/detail/' . $value['id'],
                'rate' => $highScore[$value['id']]['avg'],
            ];
        }
        return response()->json($data);
    }

    public function getHighScore()
    {
        $high_score = [];
//        $item_id = 1;
        for ($item_id = 1; $item_id <= 60; $item_id++) {
            $comment = Comment::select()->where('item_id', $item_id)->get();
            $high_score[$item_id] = 0;
            $num = 0;
            foreach ($comment as $item) {
                $high_score[$item_id] = $high_score[$item_id] + $item['score'];
                $num++;
            }
            if (!empty($num)) {
                $score[$item_id] = [
                    'score' => $high_score[$item_id],
                    'num' => $num,
                    'avg' => number_format($high_score[$item_id] / $num,2),
                ];
            }
        }
        return $score;
    }

    public function scoreFunc($arr)
    {
        $item_id = [];
        foreach ($arr as $key => $item) {
            if ($item['avg'] >= 4) {
                $item_id[] = $key;
            }
        }
        return $item_id;
    }


}
