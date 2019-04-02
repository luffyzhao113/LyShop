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
                default: false
            }
        }
    }
</script>

<style scoped lang="less">
    .content-wrapper {
        padding: 18px;
        overflow: auto;

        & > .ivu-card {
            margin-bottom: 10px;
        }
    }
</style>