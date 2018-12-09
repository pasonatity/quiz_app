@extends('layouts.app')

@section('contents')
    <quiz-page :current-url="'{{ route('public_view_item', $quiz_id) }}'"
               :get-question-url="'{{ route('public_view_content', $quiz_id) }}'"
               :post-result-url="'{{ route('public_view_result', $quiz_id) }}'"
               :quiz-id="'{{ $quiz_id }}'"
    ></quiz-page>
@endsection
