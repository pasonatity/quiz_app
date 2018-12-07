@extends('layouts.app')

@section('contents')
    <div class="text-center">
        <h1>
            {{ config('app.name', 'Quiz.make') }}
        </h1>
    </div>
    <div class="text-center my-3">
        <a class="btn btn-primary" href="{{ route('create_quiz') }}">クイズ作成</a>
    </div>
    <div class="mx-auto">
        {{--<div class="d-flex justify-content-center">--}}
            {{--<form class="input-group form-inline col-sm-12 col-lg-4" action="{{ route('public_view_search') }}" method="get">--}}
                {{--<input type="text" name="keyword" class="form-control">--}}
                {{--<div class="input-group-append">--}}
                    {{--<button class="btn btn-outline-primary" type="submit">検索</button>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
        {{--<div class="d-flex justify-content-center my-2">--}}
            {{--@foreach($mst_tags as $mst_tag)--}}
                {{--<h5><a href="{{ route('public_view_tag', $mst_tag->id) }}" class="badge badge badge-primary tags mx-1">{{ $mst_tag->tag_name }}</a></h5>--}}
            {{--@endforeach--}}
        {{--</div>--}}

        <div class="d-flex justify-content-center mt-5">
            <h5>みんなのクイズ</h5>
            {{--<span>(人気順)</span>--}}
        </div>
        <div class="main">
            {{--<div class="text-right">--}}
                {{--<a href="" class="btn btn-link py-0 px-1">人気順</a>--}}
                {{--<a href="" class="btn btn-link py-0 px-1">新着順</a>--}}
            {{--</div>--}}
            <div class="quiz-list pb-2">
                @foreach($quizzes as $quiz)
                    <div class="my-2 mx-2 border-bottom">
                        <div>
                            <a href="{{ route('public_view_item', $quiz->id) }}">{{ $quiz->quiz_title }}</a>
                            <span class="badge badge-pill badge-secondary ml-2">挑戦数：{{ $quiz->challenge_number }}</span>
                        </div>
                        <div>
                            <span class="text-secondary sub-title">{{ $quiz->quiz_sub_title }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($quizzes->hasPages())
            <div class="justify-content-center">
                <nav aria-label="pager">
                    <ul class="pagination justify-content-between">
                        <li>
                            <a class="btn page-link badge-pill @if($quizzes->onFirstPage()) text-muted disabled @endif" href="{{ $quizzes->previousPageUrl() }}" @if($quizzes->onFirstPage()) aria-disabled="true" @endif><span aria-hidden="true">&larr;</span> 前へ</a>
                        </li>
                        <li>
                            <div class="">
                                <span aria-hidden="true">&ndash;</span>{{ $quizzes->currentPage() }}<span aria-hidden="true">&ndash;</span>
                            </div>
                        </li>
                        <li>
                            <a class="btn page-link badge-pill @if(!$quizzes->hasMorePages()) text-muted disabled @endif" href="{{ $quizzes->nextPageUrl() }}" @if(!$quizzes->hasMorePages()) area-disabled="true" @endif>次へ <span aria-hidden="true">&rarr;</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </div>
@endsection
