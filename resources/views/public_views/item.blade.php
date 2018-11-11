@extends('layouts.app')

@section('contents')
    <quiz-page :url="'{{ route('public_view_item', $quiz_id) }}'"></quiz-page>
@endsection
