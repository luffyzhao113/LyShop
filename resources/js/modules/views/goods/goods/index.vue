<template>
    <i-content :spin-show="loading">
        <i-search>
            <FormItem :label-width="0">
                <Button type="primary" icon="ios-search" @click="getLists(1)">搜索</Button>
                <Button type="success" icon="ios-add" @click="openComponent('Create')">添加</Button>
            </FormItem>
        </i-search>
        <i-table :current="page.current" :total="page.total" @on-page-change="pageChange">
            <Table :columns="table.columns" :data="table.data">

            </Table>
        </i-table>
        <component v-bind:is="'Create'" :props="component.prop" @on-close="closeComponent" @on-refresh="getLists(1)"></component>
    </i-content>
</template>

<script>
    import IContent from "../../../components/content/index";
    import ISearch from "../../../components/content/search";
    import ITable from "../../../components/content/table";
    import contentListPage from "../../../mixins/content-list-page"
    import Create from './create'

    export default {
        name: "index",
        mixins: [contentListPage],
        components: {ITable, ISearch, IContent, Create},
        data() {
            return {
                loading: false,
                table: {
                    columns: [{
                        title: '商品名称',
                        slot: 'name',
                        width: 200
                    }, {
                        title: '商品分类',
                        slot: 'categories'
                    },{
                        title: '价格',
                        slot: 'price'
                    }, {
                        title: '库存',
                        slot: 'stock'
                    }, {
                        title: '类型',
                        slot: 'type'
                    },{
                        title: '查看次数',
                        slot: 'view'
                    },{
                        title: '销量',
                        slot: 'sales'
                    },{
                        title: '收藏次数',
                        slot: 'collect'
                    }, {
                        title: '状态',
                        slot: 'status'
                    }, {
                        title: '操作',
                        slot: 'action'
                    },]
                },
                search: {}
            }
        }
    }
</script>

<style scoped>

</style>