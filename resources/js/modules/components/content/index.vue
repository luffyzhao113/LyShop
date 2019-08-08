<template>
    <div class="content-wrapper">
        <slot></slot>
        <Spin size="large" fix v-if="spinShow"></Spin>
    </div>
</template>

<script>
    export default {
        name: "i-content",
        props: {
            spinShow: {
                type: Boolean,
                default: true
            }
        }
    }
</script>

<style scoped lang="less">
    .content-wrapper {
        overflow: auto;
        display: flex;
        flex-flow: column;
        & > .ivu-card {
            margin-bottom: 10px;
        }
    }
</style>