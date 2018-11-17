<template>
    <div id="accordion">
        <div class="card my-2">
            <div class="card-header">
                <div class="mb-0">
                    <div class="form-group">
                        <button type="button" class="btn-none" @click="onToggle" :aria-expanded="question.toggle">
                            <i class="fas" :class="[question.toggle ? 'fa-chevron-down' : 'fa-chevron-up']"></i>
                        </button>
                        <label class="required-label">問題内容{{ questionNumber }}</label>
                        <button type="button" class="close ml-auto" @click="removeQuestion">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <input type="text"
                               class="form-control"
                               :class="{'is-invalid': errors.has('questions.' + index + '.content')}"
                               :name="'question['+ index  + ']content'"
                               v-model="question.content"
                               placeholder="問題内容を入力してください"
                        />
                        <div v-if="errors.has('questions.' + index + '.content')" class="invalid-feedback">
                            {{ errors.get('questions.' + index + '.content') }}
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="question.toggle">
                <div class="card-body">
                    <div class="form-group">
                        <label class="required-label">選択肢:正解</label>
                        <input type="text"
                               class="form-control"
                               :class="{'is-invalid': errors.has('questions.' + index + '.correct')}"
                               v-model="question.correct"
                               placeholder="正解を入力してください"
                        />
                        <div v-if="errors.get('questions.' + index + '.correct')" class="invalid-feedback">
                            {{ errors.get('questions.' + index + '.correct') }}
                        </div>
                    </div>
                    <div class="">
                        <label class="required-label">選択肢:不正解(最大{{ maxIncorrect }}個)</label>
                        <InputIncorrect :incorrect="incorrect"
                                        :incorrectIndex="incorrectIndex"
                                        :index="index"
                                        :errors="errors"
                                        :key="incorrectIndex"
                                        @removeItem="removeItem"
                                        v-for="(incorrect, incorrectIndex) in question.incorrect"
                        ></InputIncorrect>
                        <button type="button" class="btn btn-none" @click="addItem">
                            <i class="fas fa-plus-circle fa-2x blue"></i>
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
        props: ['question', 'index', 'maxIncorrect', 'errors'],
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