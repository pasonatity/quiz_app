@extends('layouts.app')

@section('contents')
    <edit-page :index-url="'{{ route('my_page_index') }}'" :post-url="'{{ route('my_page_update', $id) }}'" :id="'{{ $id }}'"></edit-page>
@endsection
