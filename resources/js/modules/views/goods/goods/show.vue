<template>
    <i-drawer :loading="loading" title="查看商品">
        <Row :gutter="20">
            <Col :span="14">
                <show-galleries v-model="data.galleries"></show-galleries>
            </Col>
            <Col :span="10">
                <h3>{{data.name}}</h3>
                <div>单价： {{data.price}}</div>
                <div>库存：{{data.stock}} {{data.detail.unit}}</div>
            </Col>
        </Row>
    </i-drawer>
</template>

<script>
    import contentDrawer from '../../../mixins/content-drawer'
    import IDrawer from "../../../components/content/drawer";
    import ShowGalleries from "./show-galleries";

    export default {
        name: "show",
        mixins: [contentDrawer],
        components: {ShowGalleries, IDrawer},
        data(){
            return {
                loading: true,
                data:{
                    galleries: [],
                    detail:{}
                },
            }
        },
        mounted() {
            this.$http.get(`goods/goods/${this.props.id}`).then((res) => {
                this.data = res.row;
            }).finally(() => {
                this.loading = false
            })
        }
    }
</script>

<style scoped>

</style>