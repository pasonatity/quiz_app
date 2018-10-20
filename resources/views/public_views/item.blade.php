@extends('layouts.app')

@section('contents')
    <div id="quiz">
        <div v-if="!panel.data && !panelError" class="text-center">読み込み中...</div>
        <div v-if="panelError" v-cloak class="text-center">指定URLのクイズは見つかりません</div>
        <div v-if="panel.data" v-cloak class="main text-center">
            <h3>@{{ panel.data.quiz_title }}</h3>
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
