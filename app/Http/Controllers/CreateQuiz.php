<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateQuiz extends Controller
{
    public function __invoke()
    {
        if (Auth::check()) {
            return view('my_pages.create');
        }
        return view('public_views.twitter_login');
    }
    
}
