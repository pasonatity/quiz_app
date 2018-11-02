@extends('layouts.app')

@section('contents')
    <div id="inputQuiz" class="mx-auto">
        <div class="main">
            <form>
                <div class="form-group">
                    <label for="quizTitle" class="required-label">クイズタイトル</label>
                    <input type="text" class="form-control" placeholder="クイズタイトルを入力してください">
                </div>
                <div class="form-group pb-4">
                    <label for="quizSubTitle">クイズサブタイトル</label>
                    <input type="text" class="form-control" placeholder="クイズサブタイトルを入力してください">
                </div>
                <input-question v-bind:question="question" v-bind:question-index="index" v-bind:key="index" v-on:remove="removeQuestion" v-for="(question, index) in questions"></input-question>
                <button type="button" class="btn btn-primary" v-on:click="addQuestion">問題追加</button>
                <div class="my-4">
                    <div>ステータス</div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="published" value="1" checked="checked"> 公開する
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="published" value="0"> 公開しない
                        </label>
                    </div>
                    <div class="pt-4">
                        <button type="button" name="save" class="col-md-4 btn btn-primary btn-block mx-auto width-200">保存</button>
                        <button type="button" name="saveResult" class="col-md-4 btn btn-outline-primary btn-block mx-auto width-200">結果コメントを作成</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
