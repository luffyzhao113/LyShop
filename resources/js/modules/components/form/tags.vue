<template>
    <div class="form-tags">
        <Tag v-for="(item, index) in specs" :key="index" :name="index" closable @on-close="handleClose" type="dot">{{item}}</Tag>
        <div class="form-tags-input">
            <Input ref="addTags" :placeholder="placeholder" search :enter-button="'添加' + placeholder"
                   @on-search="onSearch"></Input>
        </div>
    </div>
</template>

<script>
    import Emitter from 'iview/src/mixins/emitter'
    export default {
        name: "form-tags",
        mixins: [Emitter],
        props: {
            placeholder: {
                type: String,
                default: '标签'
            },
            value: {
                type: Array,
                default: () => []
            }
        },
        data() {
            return {
                specs: this.value
            }
        },
        methods: {
            onSearch(value) {
                if (value !== '' && this.specs.find((n) => n === value) === undefined) {
                    this.specs.push(value);
                    this.$refs['addTags'].handleClear();
                    this.$emit('input', this.specs);
                    this.dispatch('FormItem', 'on-form-blur', this.specs);
                }else{
                    this.$Message.error(this.placeholder + ' 不能为空，或者以存在！');
                }
            },
            handleClose(event, name) {
                this.specs.splice(name, 1);
                this.dispatch('FormItem', 'on-form-blur', this.specs);
                this.$emit('input', this.specs);
            }
        },
        watch: {
            value(val) {
                this.specs = val
            }
        }
    }
</script>

<style scoped lang="less">
    .form-tags-input {
        width: 250px;
        display: inline-block;
        vertical-align: middle;
    }
</style>