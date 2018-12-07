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
        props: ['indexUrl', 'postUrl'],
        data () {
            return {
                quiz: {
                    quizTitle: '',
                    quizSubTitle: '',
                    publicType:1,
                    questions: [
                        {content: '', correct: '', incorrect: [{item: ''}], toggle: true}
                    ]
                }
            }
        }
    }
</script>

<style scoped>

</style>