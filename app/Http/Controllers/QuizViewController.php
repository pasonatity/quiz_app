<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Resources\QuizViewResource;

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
            $this->increaseChallengeNumber($quiz_content);
        }
        return new QuizViewResource($quiz_content);
    }

    // 挑戦数+1
    private function increaseChallengeNumber($quiz)
    {
        \Debugbar::log('挑戦数＋１');
        $quiz->challenge_number += 1;
        $quiz->save();
    }
}
