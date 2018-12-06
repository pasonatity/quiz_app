<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Item;
use Auth;
use App\Http\Controllers\TopPageController;
use App\Http\Resources\QuizResource;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::whereUser(Auth::id())->paginate(TopPageController::PAGE_COUNT);
        return view('my_pages.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('my_pages.create');
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
        DB::transaction(function () use ($request) {
            // クイズテーブル登録
            $quiz = new Quiz();
            $quiz->fill([
                'user_id'         => Auth::id(),
                'quiz_title'      => $request->quizTitle,
                'quiz_sub_title'  => $request->quizSubTitle,
                'public_type'     => $request->publicType,
                'question_number' => $request->questionNumber
            ])->save();

            foreach ($request->questions as $request_question) {
                \Debugbar::log($request_question);
                // 質問テーブル登録
                $question = new Question();
                $question->fill([
                    'quiz_id'          => $quiz->id,
                    'question_content' => $request_question['content']
                ])->save();

                // 項目テーブル(正解)登録
                $item_correct = new Item();
                $item_correct->fill([
                    'question_id'  => $question->id,
                    'item_content' => $request_question['correct'],
                    'correct'      => true
                ])->save();

//                throw new \Exception('例外テスト');

                foreach ($request_question['incorrect'] as $request_incorrect) {
                    // 項目テーブル(不正解)登録
                    $item_incorrect = new Item();
                    $item_incorrect->fill([
                        'question_id'  => $question->id,
                        'item_content' => $request_incorrect['item'],
                        'correct'      => false
                    ])->save();
                }
            }
        });
        $request->session()->flash('msg_save', '保存しました');
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
        return new QuizResource(Quiz::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::whereUser(Auth::id())->where('id', $id)->first();

        if (!$quiz) {
            return redirect(route('my_page_index'))->with('msg_error', 'クイズが見つかりませんでした');
        }
        \Debugbar::log($quiz);
        return view('my_pages.edit', compact('quiz','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\QuizRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizRequest $request, $id)
    {
        \Debugbar::log($request->all());
        DB::transaction(function () use ($request, $id) {
            // クイズテーブル登録
            $quiz = Quiz::find($id);
            $quiz->fill([
//                'user_id'         => Auth::id(),
                'quiz_title'      => $request->quizTitle,
                'quiz_sub_title'  => $request->quizSubTitle,
                'public_type'     => $request->publicType,
                'question_number' => $request->questionNumber
            ])->save();

            foreach ($request->questions as $request_question) {
                \Debugbar::log($request_question);
                // 質問テーブル登録
                $question = Question::find($quiz->id);
                $question->fill([
//                    'quiz_id'          => $quiz->id,
                    'question_content' => $request_question['content']
                ])->save();

                // 項目テーブル(正解)登録
                $item_correct = Item::where('id', $question->id)
                    ->where('correct', true)
                    ->first();
                $item_correct->fill([
//                    'question_id'  => $question->id,
                    'item_content' => $request_question['correct'],
//                    'correct'      => true
                ])->save();

//                throw new \Exception('例外テスト');

                foreach ($request_question['incorrect'] as $request_incorrect) {
                    // 項目テーブル(不正解)登録
                    $item_incorrect = Item::where('id', $question->id)
                        ->where('correct', false)
                        ->get();
                    $item_incorrect->fill([
                        'question_id'  => $question->id,
                        'item_content' => $request_incorrect['item'],
                        'correct'      => false
                    ])->save();
                }
            }
        });
        $this->flashMsgSave($request);
        return;
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

    private function flashMsgSave($request)
    {
        $request->session()->flash('msg_save', '保存しました');
    }
}
