<template>
    <div id="inputQuiz" class="mx-auto">
        <div class="main">
            <form @submit.prevent="onSubmit" method="post">
                <div class="form-group">
                    <label for="quizTitle" class="title-label">クイズタイトル</label><span class="required-label"></span>
                    <input type="text"
                           class="form-control"
                           name="quizTitle"
                           :class="{'is-invalid': errors.has('quizTitle')}"
                           v-model="quizTitle"
                           v-validate="'required'"
                           placeholder="クイズタイトルを入力してください"
                    />
                    <span>{{ errors.first('quizTitle') }}</span>
                    <!--<div v-if="errors.has('quizTitle')" class="invalid-feedback">-->
                        <!--{{ errors.get('quizTitle') }}-->
                    <!--</div>-->
                </div>
                <div class="form-group pb-4">
                    <label for="quizSubTitle" class="title-label">クイズサブタイトル</label>
                    <input type="text"
                           class="form-control"
                           v-model="quizSubTitle"
                           placeholder="クイズサブタイトルを入力してください"
                    />
                </div>
                <InputQuestion :question="question"
                               :index="index"
                               :maxIncorrect="maxIncorrect"

                               :key="index"
                               @removeQuestion="removeQuestion"
                               @onToggle="onToggle"
                               @addItem="addItem"
                               @removeItem="removeItem"
                               v-for="(question, index) in questions"
                ></InputQuestion>
                <button type="button" class="btn btn-primary" @click="addQuestion">問題追加</button>
                <div class="my-4" >
                    <!--<button type="submit" name="save" class="col-md-4 btn btn-primary btn-block mx-auto width-200">保存</button>-->
                    <button type="button" @click="nextSetting" name="nextSetting" class="col-md-4 btn btn-outline-primary btn-block mx-auto width-200">次へ</button>
                    <!--<button type="button" @click="onSubmit" name="saveResult" class="col-md-4 btn btn-outline-primary btn-block mx-auto width-200">結果コメントを作成</button>-->
                    <button v-show="false" type="button" name="quizSetting" ref="quizSettingBtn" class="btn btn-primary" data-toggle="modal" data-target="#setQuizView">
                        クイズ設定
                    </button>
                </div>
            </form>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="setQuizView" tabindex="-1" role="dialog" aria-labelledby="setQuizView" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="setQuizViewLabel">クイズ設定</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <label class="title-label">公開状態</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="public_type" value="1" checked="checked"> 一般公開
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="public_type" value="2"> 限定公開
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="public_type" value="3"> 非公開
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="title-label">出題問題数</label><span>(最大20問)</span>
                            <div class="form-inline">
                                <select class="form-control col-4">
                                    <option v-for="n in setQuestion">{{ n }}</option>
                                </select>
                                <span class="mx-1">問</span>
                                <span>(作成問題数:{{ questions.length }})</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                        <button type="button" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // import {Errors} from "../errors";
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
                // errors: new Errors(),
                maxQuestion: 100,
                maxSetQuestion: 20,
                maxIncorrect: 4
            }
        },
        computed: {
            setQuestion() {
                return this.maxSetQuestion < this.questions.length ? this.maxSetQuestion : this.questions.length;
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

                // axios.post('store',quiz)
                //     .then( res => {
                //         console.log('success');
                //         // location.href = '/';
                //     })
                //     .catch( e => {
                //         console.log(e.response.data.errors);
                //         this.errors.record(e.response.data.errors);
                //     });
            },
            nextSetting() {
                this.$validator.validate().then(result => {
                    if (result) {
                        console.log('validate:OK');
                        this.$refs.quizSettingBtn.click();
                    } else {
                        // console.log(this.errors);
                        for (let i = 0; i < this.errors.items.length; i++) {
                            let el = this.errors.items[i].field.match(/[\d+]/);
                            // console.log(el);
                            if (el) {
                                let index = el[0];
                                this.questions[index].toggle = true;
                            }
                        }
                        this.$nextTick(function () {
                            let firstError = document.getElementsByName(this.errors.items[0].field);
                            firstError[0].scrollIntoView({behavior: 'smooth', block: 'center'});
                        });
                    }
                });
            },
            onToggle(index) {
                this.questions[index].toggle = !this.questions[index].toggle;
            }
        }
    }
</script>
