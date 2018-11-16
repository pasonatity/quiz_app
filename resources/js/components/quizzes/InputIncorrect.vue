<template>
    <div class="mb-2">
        <div class="form-row mx-0">
            <input type="text"
                   class="form-control col px-placeholder"
                   :class="{'is-invalid': errors.has('questions.' + index + '.incorrect.' + incorrectIndex + '.item')}"
                   placeholder="不正解を入力してください"
                   v-model="incorrect.item"
            />
            <button type="button" class="close px-7px" @click="removeItem">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div v-if="errors.has('questions.' + index + '.incorrect.' + incorrectIndex + '.item')" class="invalid-feedback-block">
            {{ errors.get('questions.' + index + '.incorrect.' + incorrectIndex + '.item') }}
        </div>
    </div>
</template>

<script>
    export default {
        props: ['incorrect','index', 'incorrectIndex', 'errors'],
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