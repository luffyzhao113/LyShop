<template>
    <div ref="editor" class="editor">

    </div>
</template>

<script>
    import '../../../libs/ueditor/ueditor.config'
    import '../../../libs/ueditor/ueditor.all'
    import '../../../libs/ueditor/lang/zh-cn/zh-cn'
    import uuid from '../../mixins/uuid'
    import Emitter from 'iview/src/mixins/emitter'
    export default {
        name: "ueditor",
        mixins: [uuid, Emitter],
        props: {
            value: {
                type: String,
                default: '',
            },
            config: {
                type: Object,
                default: () => {return {}},
            }
        },
        data() {
            return {
                editor: null,
                ready: true,
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.$refs.editor.id = this.uuid;
                this.editor = UE.getEditor(this.uuid, this.config);
                this.editor.ready(() => {
                    this.editor.setContent(this.value || '');
                    this.editor.addListener("contentChange", () => {
                        const content = this.editor.getContent();
                        const plainTxt = this.editor.getPlainTxt();
                        this.ready = false;
                        this.$emit('input', content);
                        this.$emit('plainTxt', plainTxt);
                        this.dispatch('FormItem', 'on-form-blur', content);
                    });
                    this.$emit('ready', this.editor);
                })
            });
        },
        watch: {
            value(val, old){
                if(this.editor && val !== null && this.ready){
                    this.editor.setContent(this.value);
                }
            }
        }
    }
</script>

<style scoped>
    .editor{
        line-height: 1;
        position: relative;
        z-index: 8;
        width: 100%;
    }
</style>