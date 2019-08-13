<template>
    <i-drawer title="设置商品快递模板" :loading="loading">
        <Transfer
                :data="data.express"
                :target-keys="express"
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
        data() {
            return {
                loading: true,
                listStyle: {
                    width: '300px',
                    "min-height": '400px'
                },
                data: {
                    goods: {},
                    express: []
                }
            }
        },
        computed: {
            express(){
                let express = this.data.goods.express || [];
                return express.map((item) => {
                    return item['id']
                })
            }
        },
        mounted() {
            this.$http.get(`goods/goods/${this.props.id}/express`).then((res) => {
                this.data = res;
            }).finally(() => {
                this.loading = false
            })
        },
        methods: {
            handleChange3(newTargetKeys) {
                this.loading = true
                this.$http.put(`goods/goods/${this.props.id}/express`, {
                    express: newTargetKeys
                }).then((res) => {
                    this.data.goods = res;
                }).finally(() => {
                    this.loading = false
                })
            },
            render(item) {
                return item.label + ' - ' + item.description;
            }
        }
    }
</script>

<style scoped>

</style>