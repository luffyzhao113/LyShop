<template>
    <div class="list-panel">
        <slot></slot>
        <Page :current="current"  :total="total" :page-size="pageSize" show-total @on-change="change" size="small"/>
    </div>
</template>

<script>
    export default {
        name: "i-table",
        props: {
            current: {
                type: Number
            },
            total: {
                type: Number
            },
            pageSize: {
                type: Number,
                default: 15
            }
        },
        methods: {
            change(v){
                this.$emit('on-page-change', v);
            }
        }
    }
</script>

<style scoped lang="less">
.list-panel{
    background-color: #fff;
    flex: 1;
}
.ivu-page{
    margin-top: 15px;
    text-align: center;
}
</style>