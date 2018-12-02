<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizRedirectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeRedirect()
    {
        return redirect(route('my_page_index'))->with('msg_save', '保存しました');
    }
}
