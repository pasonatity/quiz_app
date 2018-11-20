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

    // 検索
    public function index(Request $request, $tag_id = null)
    {
        $keyword = $request->keyword;
        $quizzes = Quiz::whereKeyword($keyword)
            ->whereTag($tag_id)
            ->orderBy('participants_number','desc')
            ->paginate(self::PAGE_COUNT)
        ;
        $mst_tags = MstTag::all();
        return view('public_views.index', compact('quizzes', 'mst_tags'));
    }

}
