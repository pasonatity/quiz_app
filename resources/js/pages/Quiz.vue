<template>
    <div id="quiz">
        <div v-if="!panel.data && !panelError" class="text-center">読み込み中...</div>
        <div v-if="panelError" class="text-center">指定URLのクイズは見つかりません</div>
        <div v-if="panel.data" class="main text-center">
            <h3>{{ panel.data.quiz_title }}</h3>
            <h5>{{ panel.data.quiz_sub_title }}</h5>
            <div v-if="show === 'start'"
                 @click="showQuestion"
                 class="btn btn-primary my-2"
            >スタート</div>
            <QuestionPanel v-if="show === 'questionPanel'"
                           :content="panel"
                           @end-question="showResult"
            ></QuestionPanel>
            <div v-if="show === 'resultPanel'">
                <div>結果発表</div>
                <div>{{ correctNum }}  / {{ panel.data.questions.length }} 問正解</div>
                <div>{{ resultComment }}</div>
                <a :href="url" class="btn btn-primary">もう一度</a>
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
        props: ['url'],
        data() {
            return {
                panelError: false,
                panel: [],
                show: 'start',
                correctNum: 0
            }
        },
        created() {
            // クイズ取得
            axios.get(location.href + '/content').then(res => {
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
                this.show = 'resultPanel';
            }
        },
        computed: {
            resultComment() {
                let comment = this.panel.data.results.filter(el => {
                    return this.correctNum >= el.correct_number
                });
                return comment[comment.length - 1].comment;
            }
        }
    }
</script>