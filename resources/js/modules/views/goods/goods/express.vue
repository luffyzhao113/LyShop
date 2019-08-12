<template>
    <i-drawer title="设置商品快递模板" :loading="loading">
        <Transfer
                :data="express.data"
                :target-keys="goods.express"
                :list-style="listStyle"
                :render-format="render"
                filterable
                @on-change="handleChange3">
        </Transfer>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../components/content/drawer";
    import contentDrawer from '../../../mixins/content-drawer'
    export default {
        name: "express",
        mixins: [contentDrawer],
        components: {IDrawer},
        data(){
            return {
                loading: true,
                listStyle: {
                    width: '300px',
                    "min-height": '400px'
                },
                goods: {
                    express: []
                },
                express: {
                    data: []
                }
            }
        },
        mounted() {
            this.$http.get(`goods/goods/${this.props.id}/express`).then((res) => {
                this.data = res.row;
            }).finally(() => {
                this.loading = false
            })
        },
        methods: {
            handleChange3 (newTargetKeys) {
                this.goods.express = newTargetKeys;
            },
            render (item) {
                return item.label + ' - ' + item.description;
            }
        }
    }
</script>

<style scoped>

</style>