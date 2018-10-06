@extends('layouts.app')

@section('contents')
    <div class="mx-auto">
        <div class="d-flex justify-content-center">
            <form class="form-inline mx-auto" action="{{ route('public_view_search') }}" method="get">
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
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ mix('css/public_views/index.css') }}" rel="stylesheet">
@endpush