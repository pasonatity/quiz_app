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
            <div v-if="show === 'resultPanel'" class="">
                <div class="alert alert-info">
                    <h5 class="alert-heading"><strong>結果発表</strong></h5>
                    <div>{{ correctNum }}  / {{ panel.data.questions.length }} 問正解</div>
                    <div>{{ resultComment }}</div>
                </div>
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