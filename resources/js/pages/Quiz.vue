<template>
    <div>
        <div v-if="!panel.data && !panelError" class="text-center">読み込み中...</div>
        <div v-if="panelError" v-cloak class="text-center">指定URLのクイズは見つかりません</div>
        <div v-if="panel.data" v-cloak class="main text-center">
            <h3>@{{ panel.data.quiz_title }}</h3>
            <h5>@{{ panel.data.quiz_sub_title }}</h5>
            <div v-if="show === 'start'" v-on:click="showQuestion" class="btn btn-primary my-2">スタート</div>
            <QuizPannel v-if="show === 'questionPanel'" v-bind:content="panel" v-on:end-question="showResult"></QuizPannel>
            <div v-if="show === 'resultPanel'">
                <div>結果発表</div>
                <div>@{{ correctNum }}  / @{{ panel.data.questions.length }} 問正解</div>
                <div>@{{ resultComment }}</div>
                <a :href="url" class="btn btn-primary">もう一度</a>
            </div>
        </div>
    </div>
</template>

<script>
import QuizPannel from '../components/QuizPannel.vue'

export default {
    components: {
        QuizPannel,
    },
    props: [ 'url' ],
    data: function () {
        return {
            panelError: false,
            panel: [],
            show: 'start',
            correctNum: 0,
        }
    },
    created() {
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
            return comment.slice(-1)[0].comment;
        }
    }
}
</script>