@extends('layouts.app')

@section('contents')
    <create-page :index-url="'{{ route('my_page_index') }}'" :store-url="'{{ route('my_page_store') }}'"></create-page>
@endsection
