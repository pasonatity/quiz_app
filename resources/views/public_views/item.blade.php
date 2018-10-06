@extends('layouts.app')

@section('contents')
    <div id="quiz">
        <div v-if="!panel.data" class="text-center m">読み込み中...</div>
        <div v-if="panel.data" v-cloak class="container-panel text-center">
            <h3 class="mt-2">@{{ panel.data.quiz_title }}</h3>
            <h5>@{{ panel.data.quiz_sub_title }}</h5>
            <div v-if="show === 'start'" v-on:click="showQuestion" class="btn btn-primary my-2">スタート</div>
            <question-panel v-if="show === 'questionPanel'" v-bind:content="panel" v-on:end-question="showResult"></question-panel>
            <div v-if="show === 'resultPanel'">
                <div>結果発表</div>
                <div>@{{ correctNum }}  / @{{ panel.data.questions.length }} 問正解</div>
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