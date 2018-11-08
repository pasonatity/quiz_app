<template>
    <div id="accordion">
        <div class="card my-2">
            <div class="card-header">
                <div class="mb-0">
                    <div class="form-group">
                        <button type="button" class="btn-none" @click="toggle" :aria-expanded="question.openToggle">
                            <i class="fas" :class="[question.openToggle ? 'fa-chevron-down' : 'fa-chevron-up']"></i>
                        </button>
                        <label class="required-label">問題内容{{ questionNumber }}</label>
                        <button type="button" class="close ml-auto" @click="remove">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <input type="text"
                               class="form-control"
                               :class="{'is-invalid': required(question.content)}"
                               :name="'question'+ index"
                               v-model="question.content"
                               placeholder="問題内容を入力してください"
                        />
                        <div v-if="required(question.content)" class="invalid-feedback required-text">
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="openToggle">
                <div class="card-body">
                    <div class="form-group">
                        <label class="required-label">選択肢:正解</label>
                        <input type="text"
                               class="form-control"
                               :class="{'is-invalid': required(question.correct)}"
                               :name="'question'+ index + 'correct'"
                               v-model="question.correct"
                               placeholder="正解の選択肢を入力してください"
                        />
                        <div v-if="required(question.correct)" class="invalid-feedback required-text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required-label">選択肢:不正解(最大5個)</label>
                        <textarea class="form-control"
                                  :class="{'is-invalid': required(question.incorrect)}"
                                  :name="'question'+ index + 'incorrect'"
                                  v-model="question.incorrect"
                                  placeholder="不正解の選択肢をカンマ区切りで入力してください"
                                  rows="3"
                        ></textarea>
                        <div v-if="required(question.incorrect)" class="invalid-feedback required-text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['question', 'index', 'submit'],
        data() {
            return {
                openToggle: true
            }
        },
        computed: {
            questionNumber() {
                return this.index + 1
            },
            required() {
                return function (value) {
                    return this.submit && value === '' ? true : false
                }
            }
        },
        methods: {
            remove() {
                this.$emit('remove', this.index)
            },
            toggle() {
                this.$emit('toggle', this.index)
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