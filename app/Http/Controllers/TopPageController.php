<?php

namespace App\Http\Controllers;

use App\Repositories\PublicView\PublicViewRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\MstTag;

class TopPageController extends Controller
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
}
