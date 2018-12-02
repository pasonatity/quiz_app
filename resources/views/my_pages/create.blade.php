@extends('layouts.app')

@section('contents')
    <create-page :url="'{{ route('my_page_store_redirect') }}'"></create-page>
@endsection
