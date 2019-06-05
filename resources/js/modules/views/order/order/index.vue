<template>
    <i-content :spin-show="loading">
        <i-search v-model="search"></i-search>
        <i-table :current="page.current" :total="page.total" @on-page-change="pageChange">
            <Table :columns="table.columns" :data="table.data">
                <template slot-scope="{ row, index }" slot="status">
                    <span v-if="row.status === 'unpaid'">待支付</span>
                    <span v-if="row.status === 'paid'">待发货</span>
                    <span v-if="row.status === 'shipped'">已发货</span>
                    <span v-if="row.status === 'sign'">已签收</span>
                    <span v-if="row.status === 'apply_return'">申请退货中</span>
                    <span v-if="row.status === 'returning'">退货中</span>
                    <span v-if="row.status === 'returned'">退货完成</span>
                    <span v-if="row.status === 'cancel'">取消</span>
                </template>

                <template slot-scope="{row}" slot="express">
                    <div>
                        <div>{{row.express.name}}</div>
                        <div>{{row.express_no}}</div>
                    </div>
                </template>

                <template slot-scope="{row}" slot="member">
                    <span>{{row.member.name}}</span>
                </template>

                <template slot-scope="{row}" slot="action">
                    <span>操作</span>
                </template>
            </Table>
        </i-table>
    </i-content>
</template>

<script>
    import IContent from "../../../components/content/index";
    import ISearch from "../../../components/content/search";
    import ITable from "../../../components/content/table";
    import contentListPage from "../../../mixins/content-list-page";

    export default {
        name: "index",
        mixins: [contentListPage],
        components: {IContent, ISearch, ITable},
        data(){
            return {
                loading: false,
                search: {},
                table: {
                    columns: [{
                        title: '商品',
                        type: 'expand',
                        width: 60,
                        render: (h, params) => {
                            return h('div', 'aaa')
                        }
                    },{
                        title: '订单编号',
                        key: 'code',
                        minWidth: 150
                    },{
                        title: '用户',
                        slot: 'member',
                        minWidth: 150
                    }, {
                        title: '订单状态',
                        slot: 'status',
                        width: 100
                    }, {
                        title: '快递信息',
                        slot: 'express',
                        minWidth: 150
                    },{
                        title: '商品数量',
                        key: 'count',
                        width: 100
                    }, {
                        title: '订单总价',
                        key: 'product_total',
                        width: 100
                    }, {
                        title: '操作',
                        key: 'action',
                        width: 150
                    }]
                }
            }
        }
    }
</script>

<style scoped>

</style>