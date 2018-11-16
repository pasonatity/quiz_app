<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Resources\Quiz as QuizResource;

class QuizViewController extends Controller
{
    // クイズパネル
    public function item($quiz_id)
    {
        return view('public_views.item', compact('quiz_id'));
    }

    // クイズ内容
    public function content($quiz_id)
    {
        $quiz_content = Quiz::where('id', $quiz_id)->first();
        if($quiz_content) {
            $this->increaseParticipantsNumber($quiz_content);
        }
        return new QuizResource($quiz_content);
    }

    // 参加人数+1
    private function increaseParticipantsNumber($quiz)
    {
        \Debugbar::log('参加人数＋１');
        $quiz->participants_number += 1;
        $quiz->save();
    }
}
