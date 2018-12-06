<template>
    <From :index-url="indexUrl" :post-url="postUrl" :quiz="quiz"></From>
</template>

<script>
    import From from '../components/quizzes/Form'
    import InputQuestion from '../components/quizzes/InputQuestion.vue'
    import InputIncorrect from '../components/quizzes/InputIncorrect.vue'
    export default {
        components: {
            From,
            InputQuestion,
            InputIncorrect
        },
        props: ['indexUrl', 'postUrl', 'quizSample', 'id'],
        data () {
            return {
                quiz:{
                    quizTitle: '',
                    quizSubTitle: '',
                    publicType:1,
                    questions: [
                        {content: '', correct: '', incorrect: [{item: ''}], toggle: true}
                    ]
                },
                sample:{}
            }
        },
        created() {
            axios.get('/my_page/show/' + this.id).then(res => {
                let resData = res.data;
                for(let i = 0; i < resData.data.questions.length; i++) {
                    resData.data.questions[i].toggle = true;
                }
                this.sample = resData.data;
            }).catch(error => {
                // this.panelError = true;
            });
        }
    }
</script>

<style scoped>

</style>