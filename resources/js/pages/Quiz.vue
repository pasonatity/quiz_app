<template>
    <div id="quiz">
        <!--<i class="fas fa-spinner faa-spin animated"></i>-->
        <div v-if="!panel.data && !panelError" class="text-center">読み込み中...</div>
        <div v-if="panelError" class="text-center">指定URLのクイズは見つかりません</div>
        <div v-if="panel.data" class="main text-center">
            <div v-if="show === 'start' || show === 'resultPanel'">
                <h3>{{ panel.data.quiz_title }}</h3>
                <h5>{{ panel.data.quiz_sub_title }}</h5>
                <div @click="showQuestion"
                     v-if="show === 'start'"
                     class="btn btn-primary my-2"
                >スタート</div>
            </div>
            <QuestionPanel v-if="show === 'questionPanel'"
                           :content="panel"
                           @end-question="showResult"
            ></QuestionPanel>
            <div v-if="show === 'resultPanel'">
                <div class="d-flex justify-content-center">
                    <div class="alert alert-info col-8 col-md-4">
                        <h5 class="alert-heading"><strong>結果発表</strong></h5>
                        <div>{{ correctNum }}  / {{ panel.data.questions.length }} 問正解！</div>
                        <a :href="tweetUrl"
                           class="btn btn-primary"
                           id="tweet-btn"
                           onClick="window.open(encodeURI(decodeURI(this.href)),'sharewindow','width=550, height=450, personalbar=0, toolbar=0, scrollbars=1, sizable=1'); return false;"
                        ><i class="fab fa-twitter"></i> ツイート</a>
                    </div>
                </div>
                <a :href="currentUrl" class="btn btn-primary">もう一度</a>
            </div>
        </div>
    </div>
</template>

<script>
    import QuestionPanel from '../components/public_veiws/QuestionPanel'
    export default {
        components: {
            QuestionPanel
        },
        props: ['currentUrl', 'getQuestionUrl', 'postResultUrl', 'quizId'],
        data() {
            return {
                panelError: false,
                panel: [],
                show: 'start',
                correctNum: 0,
                tweetUrl:''
            }
        },
        created() {
            // クイズ取得
            axios.get(this.getQuestionUrl).then(res => {
                let resData = res.data;
                this.panel = resData;
            }).catch(error => {
                this.panelError = true;
            });
        },
        methods: {
            showQuestion() {
                this.show = 'questionPanel';
            },
            showResult(correctNum) {
                this.correctNum = correctNum;
                this.tweetUrl = 'https://twitter.com/share?&text=' +
                    this.panel.data.quiz_title + '%0a' + this.correctNum + ' / ' + this.panel.data.questions.length  + '問正解！' + '%0a' +
                    '&hashtags=quiz.make' +
                    '&url=' + this.currentUrl;

                axios.post(this.postResultUrl, {
                    id: this.quizId,
                    questionSum: this.panel.data.questions.length,
                    correctSum: this.correctNum
                }).then(res => {
                }).catch(e => {
                });
                this.show = 'resultPanel';
            }
        }
    }
</script>