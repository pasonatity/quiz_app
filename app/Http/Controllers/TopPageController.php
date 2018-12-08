<?php

namespace App\Http\Controllers;

use App\Repositories\PublicView\PublicViewRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\MstTag;

class TopPageController extends Controller
{
    CONST PAGE_COUNT = 10;
    // トップページ
    public function index()
    {
        $quizzes = Quiz::where('public_type', 1)->orderBy('challenge_number','desc')->paginate(self::PAGE_COUNT);
        $mst_tags = MstTag::all();
        return view('public_views.index', compact('quizzes','mst_tags'));
    }

    // 検索
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $quizzes = Quiz::whereKeyword($keyword)->where('public_type', 1)->paginate(self::PAGE_COUNT);
        $mst_tags = MstTag::all();
        \Debugbar::log($request->old('keyword'));
        return view('public_views.index', compact('quizzes', 'mst_tags'));
    }

    // タグ検索
    public function tag($tag_id)
    {
        $quizzes = Quiz::whereTag($tag_id)->where('public_type', 1)->paginate(self::PAGE_COUNT);
        $mst_tags = MstTag::all();
        return view('public_views.index', compact('quizzes', 'mst_tags'));
    }
}
