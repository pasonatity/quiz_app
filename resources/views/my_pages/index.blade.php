@extends('layouts.app')

@section('contents')
    @if(Session::has('msg_save'))
        <div class="d-flex justify-content-center">
            <div class="alert alert-warning alert-dismissible fade show col-12 col-lg-4" role="alert">
                {{ session('msg_save') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if(Session::has('msg_error'))
        <div class="d-flex justify-content-center">
            <div class="alert alert-warning alert-dismissible fade show col-12 col-lg-6" role="alert">
                {{ session('msg_error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if(Session::has('msg_delete'))
        <div class="d-flex justify-content-center">
            <div class="alert alert-warning alert-dismissible fade show col-12 col-lg-6" role="alert">
                {{ session('msg_delete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
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
                                    <a href="{{ route('public_view_item', $quiz->id) }}">{{ $quiz->quiz_title }}</a>
                                </div>
                                <div>
                                    <span class="text-secondary">{{ $quiz->quiz_sub_title }}</span>
                                </div>
                                <div>
                                    <a href="{{ route('my_page_edit', $quiz->id) }}" class="btn btn-outline-secondary btn-sm">編集</a>
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-delete" data-id="{{ $quiz->id }}">削除</button>
                                   　<form action="{{ route('my_page_destroy', $quiz->id) }}" method="post" id="form_{{ $quiz->id }}">
                                        @csrf
                                        {{ method_field('delete') }}
                                    </form>
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
    <!-- Loading -->
    <div class="loading-bg" style="display: none;">
        <div class="loading-text">
            <div>送信中...</div>
        </div>
    </div>
@endsection
