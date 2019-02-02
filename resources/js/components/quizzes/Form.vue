<template>
    <div id="inputQuiz" class="mx-auto">
        <div class="main">
            <form method="post">
                <div>
                    <div class="form-group">
                        <label for="quizTitle" class="title-label">クイズタイトル</label><span class="required-label"></span>
                        <input type="text"
                               class="form-control"
                               name="quizTitle"
                               data-vv-as="クイズタイトル"
                               :class="{'is-invalid': errors.has('quizTitle')}"
                               v-model="quiz.quizTitle"
                               v-validate="'required|max:60'"
                               placeholder="クイズタイトルを入力してください"
                        />
                        <span class="text-danger">{{ errors.first('quizTitle') }}</span>
                    </div>
                    <div class="form-group pb-4">
                        <label for="quizSubTitle" class="title-label">クイズサブタイトル</label>
                        <input type="text"
                               class="form-control"
                               name="quizSubTitle"
                               data-vv-as="クイズサブタイトル"
                               v-model="quiz.quizSubTitle"
                               v-validate="'max:60'"
                               placeholder="クイズサブタイトルを入力してください"
                        />
                    </div>
                    <span class="text-danger">{{ errors.first('quizSubTitle') }}</span>
                    <InputQuestion :question="question"
                                   :index="index"
                                   :maxIncorrect="maxIncorrect"
                                   :key="index"
                                   @removeQuestion="removeQuestion"
                                   @onToggle="onToggle"
                                   @addItem="addItem"
                                   @removeItem="removeItem"
                                   v-for="(question, index) in quiz.questions"
                    ></InputQuestion>
                    <button type="button" class="btn btn-primary" @click="addQuestion">問題追加</button>
                    <div class="my-4" >
                        <button type="button"
                                @click="nextSetting"
                                name="nextSetting"
                                class="col-md-4 btn btn-outline-primary btn-block mx-auto width-200"
                        >次へ</button>
                        <button v-show="false"
                                type="button"
                                name="quizSetting"
                                ref="quizSettingBtn"
                                class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#quizSettingModal"
                        >クイズ設定</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="quizSettingModal" tabindex="-1" role="dialog" aria-labelledby="quizSettingModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="quizSettingModalLabel">クイズ設定</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="">
                                    <label class="title-label">公開状態</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="public_type" v-model="quiz.publicType" value="1"> 一般公開
                                        </label>
                                        <small class="text-muted">(みんなに公開します)</small>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="public_type" v-model="quiz.publicType" value="2"> 限定公開
                                        </label>
                                        <small class="text-muted">(URLを知る人だけに公開)</small>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="public_type" v-model="quiz.publicType" value="3"> 非公開
                                        </label>
                                        <small class="text-muted">(公開されません)</small>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label class="title-label">出題問題数</label><span>(最大20問)</span>
                                    <div class="form-inline">
                                        <select class="form-control col-4" name="questionNumber">
                                            <option v-for="n in setQuestion" :value="n">{{ n }}</option>
                                        </select>
                                        <span class="mx-1">問</span>
                                        <span>(作成問題数:{{ quiz.questions.length }})</span>
                                        <small class="text-muted d-block">(作成した問題の中からランダムで問題を出題)</small>
                                    </div>
                                </div>
                                <div class="text-danger" v-if="responseError">
                                    エラーが発生しました。最初からやり直してください
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="noneResponseError">キャンセル</button>
                                <button type="button" class="btn btn-primary" :disabled="saveBtnDisabled" @click="onSubmit">保存</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Loading -->
        <div class="loading-bg" v-if="loading">
            <div class="loading-text">
                <div>送信中...</div>
            </div>
        </div>
    </div>
</template>

<script>
    import InputQuestion from './InputQuestion.vue'
    import InputIncorrect from './InputIncorrect.vue'
    export default {
        components: {
            InputQuestion,
            InputIncorrect
        },
        props: ['indexUrl', 'postUrl', 'quiz'],
        data() {
            return{
                maxQuestion: 100,
                maxSetQuestion: 20,
                maxIncorrect: 4,
                loading:false,
                saveBtnDisabled: false,
                responseError: false
            }
        },
        watch: {
            quiz: {
                handler() {
                    this.$nextTick(() => {
                        let questionNumber = document.getElementsByName('questionNumber')[0];
                        questionNumber.options[questionNumber.options.length - 1].selected = true;
                    });
                },
                deep: true
            }
        },
        computed: {
            setQuestion() {
                return this.maxSetQuestion < this.quiz.questions.length ? this.maxSetQuestion : this.quiz.questions.length;
            }
        },
        methods: {
            addQuestion() {
                if(this.quiz.questions.length >= this.maxQuestion) {
                    alert('問題は最大' + this.maxQuestion + '個までです')
                } else {
                    this.quiz.questions.push({content: '', correct: '', incorrect: [{item: ''}], toggle: true});
                }
            },
            removeQuestion(index) {
                if(this.quiz.questions.length <= 1) {
                    alert('問題は1個以上必要です。');
                } else {
                    if(confirm('削除します。よろしいですか？')) {
                        this.quiz.questions.splice(index, 1);
                        // this.errors.remove('questions.' + index + '.correct');
                    }
                }
            },
            addItem(index) {
                if(this.quiz.questions[index].incorrect.length >= this.maxIncorrect) {
                    alert('不正解は最大' + this.maxIncorrect + '個までです。');
                } else {
                    this.quiz.questions[index].incorrect.push({item:''});
                }
            },
            removeItem(index) {
                if(this.quiz.questions[index.questionIndex].incorrect.length <= 1) {
                    alert('不正解は1個以上必要です。');
                } else {
                    this.quiz.questions[index.questionIndex].incorrect.splice(index.incorrectIndex, 1);
                }
            },
            // 次へボタン押下時
            nextSetting() {
                this.$validator.validate().then(result => {
                    if (result) {
                        this.$refs.quizSettingBtn.click();
                    } else {
                        // console.log(this.errors);
                        for (let i = 0; i < this.errors.items.length; i++) {
                            let el = this.errors.items[i].field.match(/[\d+]/);
                            // console.log(el);
                            if (el) {
                                let index = el[0];
                                this.quiz.questions[index].toggle = true;
                            }
                        }
                        // バリデーションチェックに引っかかった項目にスクロール
                        this.$nextTick(() => {
                            let firstError = document.getElementsByName(this.errors.items[0].field);
                            firstError[0].scrollIntoView({behavior: 'smooth', block: 'center'});
                        });
                    }
                });
            },
            // 保存ボタン押下時
            onSubmit() {
                this.$nextTick(() => {
                    this.saveBtnDisabled = true;
                    this.loading = true;
                    let questionNumber = document.getElementsByName('questionNumber')[0].value;

                    // console.log(questionNumber);

                    let postQuiz = {
                        quizTitle:      this.quiz.quizTitle,
                        quizSubTitle:   this.quiz.quizSubTitle,
                        questions:      this.quiz.questions,
                        publicType:     this.quiz.publicType,
                        questionNumber: questionNumber
                    };
                    // postQuiz.questions = this.questions;

                    axios.post(this.postUrl, postQuiz)
                        .then(res => {
                            // console.log('success');
                            location.href = this.indexUrl;
                        })
                        .catch(e => {
                            this.saveBtnDisabled = false;
                            this.loading = false;
                            this.responseError = true;
                        });
                });
            },
            // 問題Panelの開閉ボタン押下時
            onToggle(index) {
                this.quiz.questions[index].toggle = !this.quiz.questions[index].toggle;
            },
            // レスポンスエラーメッセージを非表示にする
            noneResponseError() {
                this.responseError = false;
            }
        }
    }
</script>

<style scoped>

</style>