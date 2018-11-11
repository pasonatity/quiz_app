<template>
    <div id="inputQuiz" class="mx-auto">
        <div class="main">
            <form @submit.prevent="onSubmit" method="post">
                <div class="form-group">
                    <label for="quizTitle" class="required-label">クイズタイトル</label>
                    <input type="text" class="form-control" v-model="quizTitle" placeholder="クイズタイトルを入力してください">
                </div>
                <div class="form-group pb-4">
                    <label for="quizSubTitle">クイズサブタイトル</label>
                    <input type="text" class="form-control" v-model="quizSubTitle" placeholder="クイズサブタイトルを入力してください">
                </div>
                <InputQuestion :question="question"
                               :index="index"
                               :submit="submit"
                               :key="index+1"
                               @remove="removeQuestion"
                               @toggle="toggle"
                               v-for="(question, index) in questions"
                ></InputQuestion>
                <button type="button" class="btn btn-primary" @click="addQuestion">問題追加</button>
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
                        <button type="submit" name="save" class="col-md-4 btn btn-primary btn-block mx-auto width-200">保存</button>
                        <!--<button type="button" @click="onSubmit" name="saveResult" class="col-md-4 btn btn-outline-primary btn-block mx-auto width-200">結果コメントを作成</button>-->
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import InputQuestion from '../components/quizzes/InputQuestion.vue'
    export default {
        components: {
            InputQuestion
        },
        data() {
            return{
                quizTitle: '',
                quizSubTitle: '',
                questions: [
                    {content: '', correct: '', incorrect: '', openToggle: true}
                ],
                submit: false,
                error:[]
            }
        },
        methods: {
            addQuestion() {
                if(this.questions.length >= 20) {
                    alert('問題は最大20個までです')
                } else {
                    this.questions.push({content: '', correct: '', incorrect: '', openToggle: true});
                }
            },
            removeQuestion(index) {
                if(this.questions.length <= 1) {
                    alert('問題は1個以上必要です。');
                } else {
                    if(confirm('削除します。よろしいですか？')) {
                        this.questions.splice(index, 1);
                    }
                }
            },
            onSubmit() {
                this.submit = true;
                let quiz = {quizTitle: this.quizTitle, quizSubTitle: this.quizSubTitle,};
                let content = [];
                let correct = [];
                let incorrect = [];
                for (let i = 0; i < this.questions.length; i++) {
                    content.push(this.questions[i].content);
                    correct.push(this.questions[i].correct);
                    incorrect.push(this.questions[i].incorrect);
                }
                quiz.questionContent = content;
                quiz.questionCorrect = correct;
                quiz.questionIncorrect = incorrect;

                axios.post('store',quiz)
                    .then( res => {
                        console.log(res.data);
                    })
                    .catch( e => {
                        this.error = e;
                        console.log(e.response.data);
                    });
            },
            toggle(index) {
                this.questions[index].openToggle = !this.questions[index].openToggle;
            }
        }
    }
</script>
