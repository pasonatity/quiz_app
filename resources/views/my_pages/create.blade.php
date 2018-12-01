@extends('layouts.app')

@section('contents')
    <create-page :url="'{{ route('my_page_index') }}'"></create-page>
@endsection
