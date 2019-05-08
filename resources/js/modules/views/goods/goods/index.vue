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
                            <DropdownItem name="goods">修改商品</DropdownItem>
                            <DropdownItem name="galleries">修改商品组图</DropdownItem>
                            <DropdownItem name="spec">修改商品规格</DropdownItem>
                            <DropdownItem divided name="recycle">移动到回收站</DropdownItem>
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
    import ISearch from "../../../components/content/search";
    import ITable from "../../../components/content/table";
    import contentListPage from "../../../mixins/content-list-page"
    import Create from './create'
    import Update from './update'

    export default {
        name: "index",
        mixins: [contentListPage],
        components: {ITable, ISearch, IContent, Create, Update},
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
            getLists(page) {
                this.loading = true;
                this.$http.get(`goods/goods`, {
                    params: Object.assign({}, this.search, {page: page})
                }).then((data) => {
                    this.table.data = data.data
                    this.page.total = data.total
                    this.page.current = data.current_page
                }).finally(() => {
                    this.loading = false;
                });
            },
            action(name, row){
                switch (name) {
                    case 'goods':
                        this.openComponent('Update', row);
                        break;
                }
            }
        }
    }
</script>

<style scoped>

</style>