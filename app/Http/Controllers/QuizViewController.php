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
        $quiz_content = Quiz::where('id', $quiz_id)->whereIn('public_type', [1, 2])->first();
//        if($quiz_content) {
//            $this->increaseChallengeNumber($quiz_content);
//        }
        return new QuizViewResource($quiz_content);
    }

    // クイズ結果
    public function result(Request $request)
    {
        $quiz = Quiz::where('id', $request->id)->first();
        $quiz->fill([
            'challenge_number' => $quiz->challenge_number + 1,
            'question_sum'     => $quiz->question_sum + $request->questionSum,
            'correct_sum'      => $quiz->correct_sum + $request->correctSum
        ])->save();
    }

    // 挑戦数+1
//    private function increaseChallengeNumber($quiz)
//    {
//        \Debugbar::log('挑戦数＋１');
//        $quiz->challenge_number += 1;
//        $quiz->save();
//    }

}
