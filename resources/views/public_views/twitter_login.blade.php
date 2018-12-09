@extends('layouts.app')

@section('contents')
    <div class="main">
        {{--<div class="quiz-list py-2">--}}
        {{--</div>--}}
        <div class="text-center">
            ボタンをクリックし、Twitter認証を完了後ログインすることができます。
        </div>
        <div class="text-center">
            <a href="{{ route('auth_twitter') }}" class="btn btn-primary my-3"><i class="fab fa-twitter mr-1"></i>Twitterでログイン</a>
        </div>
    </div>
@endsection
