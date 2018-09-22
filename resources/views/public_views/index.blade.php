@extends('layouts.app')

@section('contents')
    <div class="">
        <form class="form-inline" action="{{ route('public_view_search') }}" method="get">
            <div class="form-group">
                <input type="text" name="keyword" class="form-control mx-sm-3">
            </div>
            <button type="submit" class="btn btn-primary">検索</button>
        </form>
            <div>
                @foreach($mst_tags as $mst_tag)
                    <a href="{{ route('public_view_tag', $mst_tag->id) }}" class="badge badge-primary">{{ $mst_tag->tag_name }}</a>
                @endforeach
            </div>
            <div>
            @foreach($quizzes as $quiz)
                <div>
                <a href="#">{{ $quiz->quiz_title }}</a><span class="badge badge-pill badge-secondary ml-2">参加者{{ $quiz->participants_number }}人</span>
                <div>
                    <span>{{ $quiz->quiz_sub_title }}</span>
                </div>
                </div>
            @endforeach
            </div>
    </div>
@endsection