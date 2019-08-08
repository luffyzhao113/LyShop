<template>
    <i-content :spin-show="loading">
        <i-search v-model="search">
            <FormItem label="商品标题">
                <Input type="text" v-model="search.name" size="small"></Input>
            </FormItem>
            <FormItem label="商品类目">
                <cascader :data="categories.data" v-model="search.categories" label="name" size="small"></cascader>
            </FormItem>
            <FormItem label="商品状态">
                <Select v-model="search.status" clearable size="small">
                    <Option value="grounding">上架</Option>
                    <Option value="undercarriage">下架</Option>
                </Select>
            </FormItem>
            <FormItem label="商品类型">
                <Select v-model="search.type" clearable size="small">
                    <Option value="normal">正常</Option>
                    <Option value="group">团购</Option>
                    <Option value="seckill">秒杀</Option>
                </Select>
            </FormItem>
            <FormItem :label-width="0">
                <Button type="primary" icon="ios-search" @click="getLists(1)" size="small">搜索</Button>
                <Button type="success" icon="ios-add" @click="openComponent('Create')" size="small">添加</Button>
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
                    <Poptip trigger="hover">
                        <div slot="content">
                            <Button size="small" @click="update(row, 'type', 'normal')">正常</Button>
                            <Button size="small" @click="update(row, 'type', 'group')">团购</Button>
                            <Button size="small" @click="update(row, 'type', 'seckill')">秒杀</Button>
                        </div>
                        <span v-if="row.type === 'normal'">正常</span>
                        <span v-if="row.type === 'group'">团购</span>
                        <span v-if="row.type === 'seckill'">秒杀</span>
                    </Poptip>
                </template>
                <template slot-scope="{ row, index }" slot="status">
                    <Poptip trigger="hover">
                        <div slot="content">
                            <Button size="small" @click="update(row, 'status', 'grounding')">上架</Button>
                            <Button size="small" @click="update(row, 'status', 'undercarriage')" style="float: right">下架</Button>
                        </div>
                        <span>{{row.status === 'grounding' ? '上架' : '下架' }}</span>
                    </Poptip>
                </template>
                <template slot-scope="{ row, index }" slot="action">
                    <Dropdown @on-click="action($event, row)">
                        <Button type="primary" size="small">
                            操作
                            <Icon type="ios-arrow-down"></Icon>
                        </Button>
                        <DropdownMenu slot="list">
                            <DropdownItem name="show">查看商品</DropdownItem>
                            <DropdownItem name="goods">修改商品</DropdownItem>
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
    import Show from './show'
    import Cascader from "../../../components/form/cascader";

    export default {
        name: "index",
        mixins: [contentListPage],
        components: {Cascader, ITable, ISearch, IContent, Create, Update, Show},
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
                search: {},
                categories: {data: []}
            }
        },
        mounted() {
            this.$http.get('goods/goods/view').then((res) => {
                this.categories.data = res.categories;
            });
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
            remove(data) {
                this.loading = true;
                this.$http.delete(`goods/goods/${data.id}`)
                    .then((res) => {
                        this.getLists();
                    }).finally(() => {
                    this.loading = false;
                });
            },
            update(row, key, value){
                let data = {};
                data[key] = value;
                this.loading = true;
                this.$http.put(`goods/goods/${row.id}/edit`, data).then(() => {
                        this.getLists(this.page.current)
                    }).finally(() => {
                        this.loading = false;
                    });
            },
            action(name, row){
                switch (name) {
                    case 'goods':
                        this.openComponent('Update', row);
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