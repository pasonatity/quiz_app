<?php

namespace App\Http\Controllers;

use App\Repositories\PublicView\PublicViewRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Tag;
use App\Models\MstTag;
use App\Http\Resources\Quiz as QuizResource;

class PublicViewController extends Controller
{
//    protected $public_view_repo;
//
//    public function __construct(
//        PublicViewRepositoryInterface $public_view_repo
//    )
//    {
//        $this->public_view_repo = $public_view_repo;
//    }

    CONST PAGE_COUNT = 10;
    // トップページ
    public function index()
    {
        $quizzes = Quiz::orderBy('participants_number','desc')->paginate(self::PAGE_COUNT);
        $mst_tags = MstTag::all();
        return view('public_views.index', compact('quizzes','mst_tags'));

    }

    // 検索
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $quizzes = Quiz::whereKeyword($keyword)->paginate(self::PAGE_COUNT);
        $mst_tags = MstTag::all();
        return view('public_views.index', compact('quizzes', 'mst_tags'));
    }

    // タグ検索
    public function tag($tag_id)
    {
        $quizzes = Quiz::whereTag($tag_id)->paginate(self::PAGE_COUNT);
        $mst_tags = MstTag::all();
        return view('public_views.index', compact('quizzes', 'mst_tags'));
    }

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
