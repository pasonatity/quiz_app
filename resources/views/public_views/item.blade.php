@extends('layouts.app')

@section('contents')
    <quiz-page v-bind:url="'{{ route('public_view_item', $quiz_id) }}'"></quiz-page>
@endsection
