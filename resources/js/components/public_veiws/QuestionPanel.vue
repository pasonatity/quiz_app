<template>
    <div>
        <div> {{ questionCount + 1 }} / {{ questionNum }}問</div>
        {{ questions[questionCount].question_content }}
        <div class="show-answer">
            <i v-if="showAnswer"
               class="fa-2x"
               :class="[correct ? 'far fa-circle text-danger' : 'fas fa-times text-primary']"
            ></i>
        </div>
        <div v-for="item in items">
            <button @click="answer($event, item)"
                    :disabled="disabled"
                    :key="item.id"
                    class="btn btn-primary my-1 col-12 col-sm-10 col-md-8 col-lg-6 select-btn"
            >{{ item.item_content }}</button>
        </div>
        <div class="show-next">
            <button type="button"
                    class="btn btn-link ml-auto"
                    @click="nextQuestion"
                    v-if="showAnswer"
            >次へ</button>
        </div>
    </div>
</template>

<script>
    export default {
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
            answer(event, item) {
                // console.log('event:' + event);
                // console.log('item:' + item);
                event.target.classList.add('on-select-btn');
                this.disabled = true;
                if (item.correct) {
                    this.correctNum++;
                    this.correct = true;
                }
                // console.log(this.correct);
                this.showAnswer = true;
            },
            nextQuestion() {
                if (this.questionCount +1 < this.questionNum) {
                    this.showAnswer = false;
                    this.questionCount++;
                    this.disabled = false;
                    this.correct = false;
                } else {
                    this.$emit('end-question', this.correctNum);
                }
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
    }
</script>

<style scoped>
    .show-answer {
        height: 40px;
    }

    .show-next {
        height: 45px;
    }

    .select-btn:disabled {
        opacity: 0.9;
    }

    .on-select-btn:disabled {
        opacity: 0.5;
        /*background-color: #227dc7;*/
    }
</style>
