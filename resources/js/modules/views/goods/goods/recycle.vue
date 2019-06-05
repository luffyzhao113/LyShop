<template>
    <i-content :spin-show="loading">
        <i-table :current="page.current" :total="page.total" @on-page-change="pageChange">
            <Table :columns="table.columns" :data="table.data">
                <template slot-scope="{ row, index }" slot="categories">
                    <span v-for="(item, key) in row.categories" :key="key">
                        {{item.name}}
                    </span>
                </template>
                <template slot-scope="{ row, index }" slot="type">
                    <span v-if="row.type === 'normal'">正常</span>
                    <span v-if="row.type === 'group'">团购</span>
                    <span v-if="row.type === 'seckill'">秒杀</span>
                </template>
                <template slot-scope="{ row, index }" slot="status">
                    <span>{{row.status === 'grounding' ? '上架' : '下架' }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="action">
                    <Dropdown @on-click="action($event, row)">
                        <Button type="primary" size="small">
                            操作
                            <Icon type="ios-arrow-down"></Icon>
                        </Button>
                        <DropdownMenu slot="list">
                            <DropdownItem name="show">查看商品</DropdownItem>
                            <DropdownItem name="recovery">恢复商品</DropdownItem>
                            <DropdownItem divided name="remove">删除商品</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>
                </template>
            </Table>
        </i-table>
        <component v-bind:is="component.is" :props="component.prop" @on-close="closeComponent"
                   @on-refresh="getLists(1)"></component>
    </i-content>
</template>

<script>
    import IContent from "../../../components/content/index";
    import contentListPage from "../../../mixins/content-list-page"
    import ISearch from "../../../components/content/search";
    import ITable from "../../../components/content/table";
    import Show from './show';

    export default {
        name: "recycle",
        mixins: [contentListPage],
        components: {IContent, ITable, ISearch, Show},
        data() {
            return {
                loading: false,
                table: {
                    columns: [{
                        title: '商品名称',
                        key: 'name',
                        ellipsis: true,
                        tooltip: true,
                        minWidth: 150
                    }, {
                        title: '商品分类',
                        slot: 'categories',
                        width: 150,
                    }, {
                        title: '价格',
                        key: 'price',
                        width: 80,
                    }, {
                        title: '库存',
                        key: 'stock',
                        width: 80,
                    }, {
                        title: '类型',
                        slot: 'type',
                        width: 80,
                    }, {
                        title: '查看次数',
                        key: 'view',
                        width: 100,
                    }, {
                        title: '销量',
                        key: 'sales',
                        width: 80,
                    }, {
                        title: '收藏次数',
                        key: 'collect',
                        width: 100,
                    }, {
                        title: '状态',
                        slot: 'status',
                        width: 80,
                    }, {
                        title: '操作',
                        slot: 'action',
                        width: 150,
                    },]
                },
                search: {}
            }
        },
        methods: {
            getLists(page = 1) {
                this.loading = true;
                this.$http.get(`goods/goods/recycle`, {
                    params: Object.assign({}, this.search, {page: page})
                }).then((data) => {
                    this.table.data = data.data
                    this.page.total = data.total
                    this.page.current = data.current_page
                }).finally(() => {
                    this.loading = false;
                });
            },
            recovery(row) {
                this.loading = true;
                this.$http.put(`goods/goods/${row.id}/recycle`).then(() => {
                    this.getLists()
                }).finally(() => {
                    this.loading = false;
                });
            },
            remove(row){
                this.loading = true;
                this.$http.delete(`goods/goods/${row.id}/recycle`).then(() => {
                    this.getLists()
                }).finally(() => {
                    this.loading = false;
                });
            },
            action(name, row){
                switch (name) {
                    case 'recovery':
                        this.recovery(row);
                        break;
                    case 'recycle':
                        this.remove(row);
                        break;
                    case 'show':
                        this.openComponent('Show', row);
                        break;
                }
            }
        }
    }
</script>

<style scoped>

</style>