<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateQuiz extends Controller
{
    public function __invoke()
    {
        if (Auth::check()) {
            return redirect(route('my_page_create'));
        }
        return view('public_views.twitter_login');
    }
    
}
