@extends('layouts.app')

@section('contents')
    <edit-page :index-url="'{{ route('my_page_index') }}'" :quiz-sample="'{{ $quiz }}'" :id="'{{ $id }}'"></edit-page>
@endsection
