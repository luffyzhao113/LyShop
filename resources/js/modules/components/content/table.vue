<template>
    <Card :title="title" :icon="icon">
        <slot></slot>
        <Page :current="current"  :total="total" :page-size="pageSize" show-total @on-change="change" size="small"/>
    </Card>
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
            },
            title: {
                type: String,
                default: '列表'
            },
            icon: {
                type: String,
                default: 'ios-list-box'
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
.ivu-page{
    margin-top: 15px;
    text-align: right;
}
</style>