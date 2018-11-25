@extends('layouts.app')

@section('contents')
    <div class="mx-auto">
        <div class="main">
            <div class="d-flex justify-content-between">
                <div>
                    <img src="{{ Auth::user()->avatar }}" class="rounded-circle twitter-avatar-size"/>
                    <span class="py-3">マイページ</span>
                </div>
                <a href="{{ route('auth_logout') }}" class="btn btn-link btn-sm">ログアウト</a>
            </div>
            <div class="quiz-list py-2">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('my_page_create') }}" class="btn btn-primary">クイズ新規作成</a>
                </div>
                @foreach($quizzes as $quiz)
                    <div class="my-2 mx-2 border-bottom">
                        <div class="py-1">
                            <div>
                                <span>{{ $quiz->quiz_title }}</span>
                            </div>
                            <div>
                                <span class="text-secondary">{{ $quiz->quiz_sub_title }}</span>
                            </div>
                            <div>
                                <a href="" class="btn btn-outline-secondary btn-sm">編集</a>
                                <button type="button" class="btn btn-outline-danger btn-sm">削除</button>
                            </div>
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
