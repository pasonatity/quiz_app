@extends('layouts.app')

@section('contents')
    <div class="mx-auto">
        <div class="main">
            <div class="quiz-list py-2">
                <a href="{{ route('auth_logout') }}" class="btn btn-primary">ログアウト</a>
                {{--@foreach($quizzes as $quiz)--}}
                    {{--<div class="my-2 mx-2 border-bottom">--}}
                        {{--<a href="{{ route('public_view_item', $quiz->id) }}">{{ $quiz->quiz_title }}</a><span class="badge badge-pill badge-secondary ml-2">参加者{{ $quiz->participants_number }}人</span>--}}
                        {{--<div>--}}
                            {{--<span class="text-secondary sub-title">{{ $quiz->quiz_sub_title }}</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            </div>
            {{--<div class="justify-content-center">--}}
                {{--<nav aria-label="pager">--}}
                    {{--<ul class="pagination justify-content-between">--}}
                        {{--<li>--}}
                            {{--<a class="btn page-link badge-pill @if($quizzes->onFirstPage()) text-muted disabled @endif" href="{{ $quizzes->previousPageUrl() }}" @if($quizzes->onFirstPage()) aria-disabled="true" @endif><span aria-hidden="true">&larr;</span> 前へ</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<div class="">--}}
                                {{--<span aria-hidden="true">&ndash;</span>{{ $quizzes->currentPage() }}<span aria-hidden="true">&ndash;</span>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a class="btn page-link badge-pill @if(!$quizzes->hasMorePages()) text-muted disabled @endif" href="{{ $quizzes->nextPageUrl() }}" @if(!$quizzes->hasMorePages()) area-disabled="true" @endif>次へ <span aria-hidden="true">&rarr;</span></a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</nav>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection
