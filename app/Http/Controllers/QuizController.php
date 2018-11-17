<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Item;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\QuizRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizRequest $request)
    {
        \Debugbar::log($request->all());
//        DB::beginTransaction();
//        try {
//            // クイズテーブル登録
//            $quiz = new Quiz();
//            $quiz->quiz_title = $request->quizTitle;
//            $quiz->quiz_sub_title = $request->quizSubTitle;
//            $quiz->save();
//            foreach ($request->questions as $request_question) {
//                // 質問テーブル登録
//                $question = new Question();
//                $question->quiz_id = $quiz->id;
//                $question->content = $request_question->content;
//                $question->save();
//
//                // 項目テーブル(正解)登録
//                $item_correct = new Item();
//                $item_correct->question_id = $question->id;
//                $item_correct->item_content = $request_question->correct;
//                $item_correct->correct = true;
//                $item_correct->save();
//
//                foreach ($request_question->incorrect as $request_incorrect) {
//                    // 項目テーブル(不正解)登録
//                    $item_incorrect = new Item();
//                    $item_incorrect->question_id = $question->id;
//                    $item_incorrect->item_content = $request_incorrect->item;
//                    $item_incorrect->correct = false;
//                    $item_incorrect->save();
//                }
//            }
//            DB::commit();
//            return true;
//
//        }catch(\PDOException $e){
//            DB::rollback();
//            return false;
//        }
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
