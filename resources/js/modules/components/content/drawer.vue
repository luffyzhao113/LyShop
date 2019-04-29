<template>
    <Drawer :title="title" :value="true" @on-visible-change="change" :transfer="false" :mask-closable="false"
            :width="width">
        <div class="modal-body">
            <slot></slot>
        </div>
        <div class="compon-drawer-footer">
            <slot name="footer"></slot>
        </div>
        <Spin size="large" fix v-if="loading"></Spin>
    </Drawer>
</template>

<script>
    export default {
        name: "i-drawer",
        props: {
            title: {
                type: String,
                default: '弹窗'
            },
            width: {
                type: Number,
                default: 720
            },
            loading: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            change(v) {
                this.$parent.closeDrawer(v)
            }
        }
    }
</script>

<style scoped>
    .modal-body {
        height: calc(100% - 53px);
        overflow-y: auto;
        margin-right: -16px;
        padding-right: 16px;
    }
    .compon-drawer-footer{
        border-top: 1px solid #e8e8e8;
        padding: 10px 16px;
        text-align: right;
        background: #fff;
    }
    .compon-drawer-footer *{
        text-align: right;
    }
</style>