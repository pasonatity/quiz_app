window.Vue = require('vue');
window.axios = require('axios');


let questionPanel = {
template: `
    <div>
        <div> {{ questionCount + 1 }}/ {{ questionNum }}問</div>
        {{ content.data.questions[questionCount].question_constent }}
        <div v-for="item in content.data.questions[questionCount].items">
            <button v-on:click="answer(item.correct)" v-bind:disabled="disabled" v-bind:key="item.id" class="btn btn-primary my-2 select-btn">
                {{ item.item_content }}
            </button>
        </div>
        <div v-if="showAnswer">
            <div>{{ correct ? '正解' : '不正解' }}</div>
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
        }
    }
};

const quiz = new Vue({
    el: '#quiz',
    data: {
        panel: [],
        show: 'start',
        correctNum: 0
    },
    created() {
        axios.get(location.href + '/content').then(res => {
            let resData = res.data;
            this.panel = resData;
        });
    },
    methods: {
        showQuestion() {
            this.show = 'questionPanel';
        },
        showResult(correctNum) {
            this.correctNum = correctNum;
            this.show ='resultPanel';
        }
    },
    computed: {
        resultComment() {
            let comment = this.panel.data.results.filter(el => {
                return this.correctNum >= el.correct_number
            });
            return comment.slice(-1)[0].comment;
        }
    },
    components: {
        'question-panel': questionPanel,
    }
});