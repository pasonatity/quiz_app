<?php

namespace App\Http\Controllers;

use App\Repositories\PublicView\PublicViewRepositoryInterface;
use Illuminate\Http\Request;


class PublicViewController extends Controller
{
    protected $public_view_repo;

    public function __construct(
        PublicViewRepositoryInterface $public_view_repo
    )
    {
        $this->public_view_repo = $public_view_repo;
    }

    // トップページ
    public function index()
    {
        $quizzes = $this->public_view_repo->getQuizList();
        $mst_tags = $this->public_view_repo->getMstTagList();
        return view('public_views.index', compact('quizzes','mst_tags'));

    }

    // 検索
    public function search(Request $request)
    {
        $quizzes = $this->public_view_repo->searchQuiz($request);
        $mst_tags = $this->public_view_repo->getMstTagList();
        return view('public_views.index', compact('quizzes', 'mst_tags'));
    }

    // タグ検索
    public function tag($tag_id)
    {
        $quizzes = $this->public_view_repo->tag($tag_id);
        $mst_tags = $this->public_view_repo->getMstTagList();
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
        $quiz_content = $this->public_view_repo->getQuizContent($quiz_id);
        return $quiz_content;

    }

}
