<?php

namespace App\Repositories\PublicView;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Tag;
use App\Models\MstTag;

class PublicViewRepository implements PublicViewRepositoryInterface
{
    /*
     * クイズ一覧取得
     *
     */
    public function getQuizList()
    {
        return Quiz::all();
    }

    /*
     * タグ一覧取得
     *
     */
    public function getMstTagList()
    {
        return MstTag::all();
    }

    /*
     * 検索
     *
     */
    public function searchQuiz(Request $request)
    {
        $keyword = $request->keyword;
        \Debugbar::log($keyword);
        $quizzes = Quiz::where('quiz_title', 'Like', '%'.$keyword.'%')
            ->orWhere('quiz_sub_title', 'Like', '%'.$keyword.'%')->get();

        \Debugbar::log($quizzes);
        return $quizzes;
    }

    /*
     * タグ検索
     *
     */
    public function tag($id)
    {
        $quizzes = Quiz::whereHas('tag', function ($query) use($id) {
            $query->where('id', $id);
        })->get();
        return $quizzes;
    }
}
