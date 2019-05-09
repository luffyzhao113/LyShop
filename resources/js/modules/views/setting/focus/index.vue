<template>
    <i-content :spin-show="loading">
        <i-search>
            <FormItem label="名称">
                <Input v-model="search.name"></Input>
            </FormItem>
            <FormItem label="位置">
                <Select v-model="search.position_id" clearable>
                    <Option v-for="(item, index) in positions.data" :key="index" :value="item.id">{{item.name}}</Option>
                </Select>
            </FormItem>
            <FormItem label="状态">
                <Select clearable v-model="search.status">
                    <Option value="on">开启</Option>
                    <Option value="off">关闭</Option>
                </Select>
            </FormItem>
            <FormItem :label-width="1">
                <Button type="primary" icon="ios-search" @click="getLists(1)">搜索</Button>
                <Button type="success" icon="ios-add" @click="openComponent('Create')">添加</Button>
                <Button type="info" @click="openRoute('setting.focus.position')">焦点图位置管理</Button>
            </FormItem>
        </i-search>
        <i-table>
            <Table :columns="table.columns" :data="table.data">
                <template slot-scope="{ row, index }" slot="name">
                    <span>{{ row.name }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="position">
                    <span>{{ row.positions | position }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="sort">
                    <span>{{ row.sort }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="status">
                    <span>{{ row.status | status}}</span>
                </template>
                <template slot-scope="{ row, index }" slot="description">
                    <span>{{ row.description }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="action">
                    <Button type="warning" size="small" @click="openComponent('Update', row)">编辑</Button>
                    <Poptip
                            confirm
                            title="你确定要删除这个权限吗？"
                            @on-ok="remove(row)">
                        <Button type="error" size="small">删除</Button>
                    </Poptip>
                </template>
            </Table>
        </i-table>

        <component v-bind:is="component.is" :props="component.prop" @on-close="closeComponent"
                   @on-refresh="getLists"></component>
    </i-content>
</template>

<script>
    import IContent from "../../../components/content/index";
    import ISearch from "../../../components/content/search";
    import ITable from "../../../components/content/table";
    import contentListPage from "../../../mixins/content-list-page"
    import Create from './create'
    import Update from './update';

    export default {
        name: "index",
        mixins: [contentListPage],
        components: {ITable, ISearch, IContent, Create, Update},
        data() {
            return {
                loading: true,
                search:{},
                positions: {data: []},
                table: {
                    columns: [{
                        title: '图片标题',
                        slot: 'name'
                    }, {
                        title: '显示位置',
                        slot: 'position'
                    }, {
                        title: '排序',
                        slot: 'sort'
                    }, {
                        title: '状态',
                        slot: 'status'
                    }, {
                        title: '图片说明',
                        slot: 'description'
                    }, {
                        title: '操作',
                        slot: 'action'
                    }]
                }
            }
        },
        mounted() {
            this.$http.get(`setting/focus/view`).then((res) => {
                this.positions.data = res.positions;
            }).finally(() => {
                this.loading = false;
            });
        },
        methods: {
            getLists(page) {
                this.loading = true;
                this.$http.get(`setting/focus`, {
                    params: Object.assign({}, this.search, {page})
                }).then((data) => {
                    this.table.data = data.data;
                    this.page.total = data.total;
                    this.page.current = data.current_page;
                }).finally(() => {
                    this.loading = false;
                });
            },
            remove(row) {
                this.loading = true;
                this.$http.delete(`setting/focus/${row.id}`).then(() => {
                    this.getLists(this.page.current);
                }).finally(() => {
                    this.loading = false;
                });
            }
        },
        filters: {
            status(val) {
                return val === 'on' ? '开启' : '关闭';
            },
            position(val) {
                return val.name || '';
            }
        }
    }
</script>

<style scoped>

</style>