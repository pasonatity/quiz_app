<template>
    <div class="mb-2">
        <div class="form-row mx-0">
            <input type="text"
                   class="form-control col px-placeholder"
                   :class="{'is-invalid': errors.has('questions[' + index + ']incorrect[' + incorrectIndex + ']item')}"
                   :name="'questions[' + index + ']incorrect[' + incorrectIndex + ']item'"
                   data-vv-as="不正解"
                   v-validate="'required|max:30'"
                   placeholder="不正解を入力してください"
                   v-model="incorrect.item"
            />
            <button type="button" class="close px-7px" @click="removeItem">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <span class="text-danger">{{ errors.first('questions[' + index + ']incorrect[' + incorrectIndex + ']item') }}</span>
    </div>
</template>

<script>
    export default {
        props: ['incorrect','index', 'incorrectIndex' ],
        inject: ['$validator'],
        methods: {
            removeItem() {
                this.$emit('removeItem', this.incorrectIndex)
            }
        }
    }
</script>

<style scoped>
    .px-placeholder {
        padding:0.375rem 0.75rem
    }
    .px-7px {
        padding-left: 7px;
        padding-right: 7px;
    }
</style>