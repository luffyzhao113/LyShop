<template>
    <i-content :spin-show="loading">
        <i-search>
            <FormItem label="模板名称">
                <Input v-model="search.name"></Input>
            </FormItem>
            <FormItem label="快递公司">
                <Select v-model="search.company_id" clearable>
                    <Option v-for="(item, index) in companies.data" :key="index" :value="item.id">{{item.name}}</Option>
                </Select>
            </FormItem>
            <FormItem :label-width="1">
                <Button type="primary" icon="ios-search" @click="getLists(1)">搜索</Button>
                <Button type="success" icon="ios-add" @click="openComponent('Create')">添加</Button>
            </FormItem>
        </i-search>
        <i-table>
            <Table :columns="table.columns" :data="table.data">
                <template slot-scope="{ row, index }" slot="name">
                    <span>{{ row.name }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="company_name">
                    <span>{{ row.company | company_name }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="description">
                    <span>{{ row.description }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="type">
                    <span>{{ row.type | type }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="status">
                    <span>{{ row.status | status }}</span>
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
    import IContent from "../../../../components/content";
    import contentListPage from "../../../../mixins/content-list-page"
    import ISearch from "../../../../components/content/search";
    import ITable from "../../../../components/content/table";
    import Create from "./create"
    import Update from "./update"

    export default {
        name: "index",
        mixins: [contentListPage],
        components: {ITable, ISearch, IContent, Create, Update},
        data() {
            return {
                table: {
                    columns: [
                        {
                            title: '模板名称',
                            slot: 'name',
                            width: 150
                        },
                        {
                            title: '快递公司',
                            slot: 'company_name',
                            width: 150
                        },
                        {
                            title: '收费类型',
                            slot: 'type',
                            width: 100
                        },
                        {
                            title: '状态',
                            slot: 'status',
                            width: 100
                        },
                        {
                            title: '模板说明',
                            slot: 'description'
                        },
                        {
                            title: '操作',
                            slot: 'action',
                            width: 200
                        }
                    ]
                },
                loading: true,
                search: {},
                companies: {data: []}
            }
        },
        mounted(){
            this.loading = true;
            this.$http.get(`setting/express/template/view`).then((res) => {
                this.companies.data = res.companies
            }).finally(() => {
                this.loading = false;
            });
        },
        methods: {
            getLists(page) {
                this.loading = true;
                this.$http.get(`setting/express/template`, {
                    params: Object.assign({}, this.search, {page})
                }).then((data) => {
                    this.table.data = data.data
                    this.page.total = data.total
                    this.page.current = data.current_page
                }).finally(() => {
                    this.loading = false;
                });
            },
            remove(row) {
                this.loading = true;
                this.$http.delete(`setting/express/template/${row.id}`).then(() => {
                    this.getLists(this.page.current);
                }).finally(() => {
                    this.loading = false;
                });
            }
        },
        filters: {
            status(val) {
                return val === 'yes' ? '开启' : '关闭';
            },
            type(val) {
                return val === 'piece' ? '按件收费' : '按重收费';
            },
            company_name(val) {
                return val.name || '';
            }
        }
    }
</script>

<style scoped>

</style>