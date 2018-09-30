@extends('layouts.app')

@section('contents')
    <div id="quiz" class="container-panel">
        <div v-if="panel.data" v-cloak>
            <div>@{{ panel.data.quiz_title }}</div>
            <div>@{{ panel.data.quiz_sub_title }}</div>
            <div v-if="show === 'start'" v-on:click="showQuestion" class="btn btn-primary">スタート</div>
            <question-panel v-if="show === 'questionPanel'" v-bind:content="panel" v-on:end-question="showResult"></question-panel>
            <div v-if="show === 'resultPanel'">
                <div>結果発表</div>
                <div>@{{ correctNum }} / @{{ panel.data.questions.length }} 問正解</div>
                <div>@{{ resultComment }}</div>
                <a href="{{ route('public_view_item', $quiz_id) }}" class="btn btn-primary">もう一度</a>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ mix('css/public_views/item.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="{{ mix('js/public_views/item.js') }}"></script>
@endpush