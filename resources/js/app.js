
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
window.axios = require('axios');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });
let questionPanel = {
    template: `
<div>
    <div> {{ questionCount + 1 }}/ {{ questionNum }}問</div>
    <div class="show-answer">
        <div v-if="showAnswer" v-bind:class="[correct ? 'text-danger' : 'text-primary']">{{ correct ? '正解' : '不正解' }}</div>
    </div>
    {{ questions[questionCount].question_content }}
    <div v-for="item in items">
        <button v-on:click="answer(item.correct)" v-bind:disabled="disabled" v-bind:key="item.id" class="btn btn-primary my-2 select-btn">
            {{ item.item_content }}
        </button>
    </div>
</div>
`,
    props: ['content'],
    data() {
        return {
            // 出題問題
            questionCount: 0,
            // 正解数
            correctNum: 0,
            // ボタン無効フラグ true:無効 false:有効
            disabled: false,
            // 正誤フラグ true:正解 false:不正解
            correct: false,
            // 回答表示フラグ
            showAnswer: false
        }
    },
    computed: {
        // 質問数
        questionNum() {
            return this.content.data.questions.length
        },
        questions() {
            return this.doShuffle(this.content.data.questions)
        },
        items() {
            return this.doShuffle(this.content.data.questions[this.questionCount].items)
        }
    },
    methods: {
        // 正誤表示・次パネル表示
        answer(event) {
            this.disabled = true;
            if (event) {
                this.correctNum++;
                this.correct = true;
            }
            // console.log(this.correct);
            this.showAnswer = true;

            // 次のパネルを表示
            setTimeout(() => {
                if (this.questionCount +1 < this.questionNum) {
                    this.showAnswer = false;
                    this.questionCount++;
                    this.disabled = false;
                    this.correct = false;
                } else {
                    this.$emit('end-question', this.correctNum);
                }
            }, 1000);
        },
        doShuffle(item) {
            let i = item.length;
            while (i) {
                let r = Math.floor(Math.random() * i);
                let tmp = item[--i];
                item[i] = item[r];
                item[r] = tmp;
            }
            return item;
        }
    }
};

const quiz = new Vue({
    el: '#quiz',
    data: {
        panelError: false,
        panel: [],
        show: 'start',
        correctNum: 0
    },
    created() {
        // クイズ取得
        axios.get(location.href + '/content').then(res => {
            let resData = res.data;
            this.panel = resData;
        }).catch(error => { this.panelError = true; });
    },
    methods: {
        showQuestion() {
            this.show = 'questionPanel';
        },
        showResult(correctNum) {
            this.correctNum = correctNum;
            this.show = 'resultPanel';
        }
    },
    computed: {
        resultComment() {
            let comment = this.panel.data.results.filter(el => {
                return this.correctNum >= el.correct_number
            });
            return comment[comment.length-1].comment;
        }
    },
    components: {
        'question-panel': questionPanel,
    }
});

let inputQuestion = {
    template: `
<div id="accordion">
    <div class="card my-2">
        <div class="card-header" v-bind:id="'heading' + index">
            <h5 class="mb-0">
                <div class="form-group">
                    <button type="button" class="btn btn-link required-label" data-toggle="collapse" v-bind:data-target="'#collapse' + index" aria-expanded="true" v-bind:aria-controls="'collapse' + index">
                        問題内容{{ index }}
                    </button>
                    <button type="button" class="close ml-auto" v-on:click="remove">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <input type="text" class="form-control" v-bind:name="'question'+ index" v-model="question.question" placeholder="問題内容を入力してください" />
                </div>
            </h5>
        </div>
        <div v-bind:id="'collapse' + index" class="collapse show" v-bind:aria-labelledby="'heading' + index" data-parent="#accordion">
            <div class="card-body">
                <div class="form-group">
                    <label class="required-label">選択肢:正解</label>
                    <input type="text" class="form-control" v-bind:name="'question'+ index + 'correct'" v-model="question.correct" placeholder="正解の選択肢を入力してください" />
                </div>
                <div class="form-group">
                    <label class="required-label">選択肢:不正解(最大5個)</label>
                    <textarea class="form-control" v-bind:name="'question'+ index + 'incorrect'" v-model="question.incorrect" placeholder="不正解の選択肢をカンマ区切りで入力してください" rows="3"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
`,
    props: ['question','questionIndex'],
    computed: {
        index() {
            return this.questionIndex+1
        }
    },
    methods: {
        remove() {
            this.$emit('remove', this.questionIndex)
        }
    }
};


const inputQuiz = new Vue({
    el: '#inputQuiz',
    data: {
        questions: [
            {question: '問題１', correct: '正解１', incorrect: '不正解１'}
        ]
    },
    methods: {
        addQuestion() {
            if(this.questions.length >= 20) {
                alert('問題は最大20個までです')
            } else {
                this.questions.push({question: '', correct: '', incorrect: ''});
            }
        },
        removeQuestion(questionIndex) {
            if(this.questions.length <= 1) {
                alert('問題は1個以上必要です。');
            } else {
                if(confirm('削除します。よろしいですか？')) {
                    this.questions.splice(questionIndex, 1);
                }
            }
        }
    },
    components: {
        'input-question': inputQuestion
    }
});