@extends('layouts.app')

@section('contents')
    <div class="mx-auto">
        <div class="d-flex justify-content-center">
            <form class="form-inline mx-auto" action="{{ route('public_view') }}" method="post">
                @csrf
                <div class="form-group mx-sm-2">
                    <input type="text" name="keyword" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
        <div class="d-flex justify-content-center my-2">
            @foreach($mst_tags as $mst_tag)
                <h5><a href="{{ route('public_view_tag', $mst_tag->id) }}" class="badge badge badge-primary tags mx-1">{{ $mst_tag->tag_name }}</a></h5>
            @endforeach
        </div>
        <div class="main">
            <div class="quiz-list py-2">
                @foreach($quizzes as $quiz)
                    <div class="my-2 mx-2 border-bottom">
                        <a href="{{ route('public_view_item', $quiz->id) }}">{{ $quiz->quiz_title }}</a><span class="badge badge-pill badge-secondary ml-2">参加者{{ $quiz->participants_number }}人</span>
                        <div>
                            <span class="text-secondary sub-title">{{ $quiz->quiz_sub_title }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
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
        </div>
    </div>
@endsection
