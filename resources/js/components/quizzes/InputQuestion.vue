<template>
    <div id="accordion">
        <div class="card my-2">
            <div class="card-header">
                <div class="mb-0">
                    <div class="form-group">
                        <button type="button" class="btn-none" @click="onToggle" :aria-expanded="question.toggle">
                            <i class="fas" :class="[question.toggle ? 'fa-chevron-down' : 'fa-chevron-up']"></i>
                        </button>
                        <label class="title-label">問題{{ questionNumber }}</label><span class="required-label"></span>
                        <button type="button" class="close ml-auto" @click="removeQuestion">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <input type="text"
                               class="form-control"
                               :class="{'is-invalid': errors.has('questions[' + index + ']content')}"
                               :name="'questions['+ index  + ']content'"
                               data-vv-as="問題"
                               v-validate="'required|max:60'"
                               v-model="question.content"
                               placeholder="問題を入力してください"
                        />
                        <span class="text-danger">{{ errors.first('questions[' + index + ']content') }}</span>
                    </div>
                </div>
            </div>
            <div v-show="question.toggle">
                <div class="card-body">
                    <div class="form-group">
                        <label class="title-label">選択肢:正解</label><span class="required-label"></span>
                        <input type="text"
                               class="form-control"
                               :class="{'is-invalid': errors.has('questions[' + index + ']correct')}"
                               :name="'questions[' + index + ']correct'"
                               data-vv-as="正解"
                               v-validate="'required|max:30'"
                               v-model="question.correct"
                               placeholder="正解を入力してください"
                        />
                        <span class="text-danger">{{ errors.first('questions[' + index + ']correct') }}</span>
                    </div>
                    <div class="">
                        <label class="title-label">選択肢:不正解</label><span>(最大{{ maxIncorrect }}個)</span><span class="required-label"></span>
                        <InputIncorrect :incorrect="incorrect"
                                        :incorrectIndex="incorrectIndex"
                                        :index="index"
                                        :key="incorrectIndex"
                                        @removeItem="removeItem"
                                        v-for="(incorrect, incorrectIndex) in question.incorrect"
                        ></InputIncorrect>
                        <button type="button" class="btn btn-none" @click="addItem">
                            <i class="fas fa-plus-circle fa-2x text-primary"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import InputIncorrect from './InputIncorrect.vue'
    export default {
        components: {
            InputIncorrect
        },
        inject: ['$validator'],
        props: ['question', 'index', 'maxIncorrect'] ,
        computed: {
            questionNumber() {
                return this.index + 1
            }
        },
        methods: {
            removeQuestion() {
                this.$emit('removeQuestion', this.index);
            },
            onToggle() {
                this.$emit('onToggle', this.index);
            },
            addItem() {
                this.$emit('addItem', this.index);
            },
            removeItem(incorrectIndex) {
                this.$emit('removeItem', {questionIndex: this.index, incorrectIndex: incorrectIndex});
            }
        }
    }
</script>

<style scoped>
    .btn-none {
        background-color: rgba(0,0,0,0);
        border: none;
        cursor: pointer;
    }

</style>