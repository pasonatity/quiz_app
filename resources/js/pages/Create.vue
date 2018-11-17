<template>
    <div id="inputQuiz" class="mx-auto">
        <div class="main">
            <form @submit.prevent="onSubmit" method="post">
                <div class="form-group">
                    <label for="quizTitle" class="required-label">クイズタイトル</label>
                    <input type="text"
                           class="form-control"
                           :class="{'is-invalid': errors.has('quizTitle')}"
                           v-model="quizTitle"
                           placeholder="クイズタイトルを入力してください"
                    />
                    <div v-if="errors.has('quizTitle')" class="invalid-feedback">
                        {{ errors.get('quizTitle') }}
                    </div>
                </div>
                <div class="form-group pb-4">
                    <label for="quizSubTitle">クイズサブタイトル</label>
                    <input type="text"
                           class="form-control"
                           v-model="quizSubTitle"
                           placeholder="クイズサブタイトルを入力してください"
                    />
                </div>
                <InputQuestion :question="question"
                               :index="index"
                               :maxIncorrect="maxIncorrect"
                               :errors="errors"
                               :key="index"
                               @removeQuestion="removeQuestion"
                               @onToggle="onToggle"
                               @addItem="addItem"
                               @removeItem="removeItem"
                               v-for="(question, index) in questions"
                ></InputQuestion>
                <button type="button" class="btn btn-primary" @click="addQuestion">問題追加</button>
                <div class="my-4">
                    <div>公開状態</div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="public_type" value="1" checked="checked"> 一般公開
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="public_type" value="2"> 限定公開
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="public_type" value="3"> 非公開
                        </label>
                    </div>
                </div>
                <div class="my-4">
                    <div>問題順</div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="sort" value="1" checked="checked"> 順番通り
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="sort" value="0"> シャッフル
                        </label>
                    </div>
                </div>
                <div class="my-4" >
                    <button type="submit" name="save" class="col-md-4 btn btn-primary btn-block mx-auto width-200">保存</button>
                    <!--<button type="button" @click="onSubmit" name="saveResult" class="col-md-4 btn btn-outline-primary btn-block mx-auto width-200">結果コメントを作成</button>-->
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import {Errors} from "../errors";
    import InputQuestion from '../components/quizzes/InputQuestion.vue'
    import InputIncorrect from '../components/quizzes/InputIncorrect.vue'
    export default {
        components: {
            InputQuestion,
            InputIncorrect
        },
        data() {
            return{
                quizTitle: '',
                quizSubTitle: '',
                questions: [
                    {content: '', correct: '', incorrect: [{item: ''}], toggle: true}
                ],
                errors: new Errors(),
                maxQuestion: 20,
                maxIncorrect: 4
            }
        },
        methods: {
            addQuestion() {
                if(this.questions.length >= this.maxQuestion) {
                    alert('問題は最大' + this.maxQuestion + '個までです')
                } else {
                    this.questions.push({content: '', correct: '', incorrect: [{item: ''}], toggle: true});
                }
            },
            removeQuestion(index) {
                if(this.questions.length <= 1) {
                    alert('問題は1個以上必要です。');
                } else {
                    if(confirm('削除します。よろしいですか？')) {
                        this.questions.splice(index, 1);
                        // this.errors.remove('questions.' + index + '.correct');
                    }
                }
            },
            addItem(index) {
                if(this.questions[index].incorrect.length >= this.maxIncorrect) {
                    alert('不正解は最大' + this.maxIncorrect + '個までです。');
                } else {
                    this.questions[index].incorrect.push({item:''});
                }
            },
            removeItem(index) {
                if(this.questions[index.questionIndex].incorrect.length <= 1) {
                    alert('不正解は1個以上必要です。');
                } else {
                    this.questions[index.questionIndex].incorrect.splice(index.incorrectIndex, 1);
                }
            },
            onSubmit() {
                let quiz = {quizTitle: this.quizTitle, quizSubTitle: this.quizSubTitle,};
                quiz.questions = this.questions;

                axios.post('store',quiz)
                    .then( res => {
                        console.log('success');
                        // location.href = '/';
                    })
                    .catch( e => {
                        console.log(e.response.data.errors);
                        this.errors.record(e.response.data.errors);
                    });
            },
            onToggle(index) {
                this.questions[index].toggle = !this.questions[index].toggle;
            }
        }
    }
</script>
