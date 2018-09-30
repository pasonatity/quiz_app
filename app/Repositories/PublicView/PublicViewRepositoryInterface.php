<?php

namespace App\Repositories\PublicView;

use Illuminate\Http\Request;

interface PublicViewRepositoryInterface
{
    /*
     * クイズ一覧取得
     *
     */
    public function getQuizList();

    /*
     * タグ一覧取得
     *
     */
    public function getMstTagList();

    /*
     * 検索
     *
     */
    public function searchQuiz(Request $keyword);

    /*
     * タグ検索
     *
     */
    public function tag($id);

    /*
     * API:クイズ内容
     *
     */
    public function getQuizContent($quiz_id);
}