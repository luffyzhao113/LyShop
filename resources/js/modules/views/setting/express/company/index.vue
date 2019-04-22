<template>
    <i-content>
        <i-search>
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
                <template slot-scope="{ row, index }" slot="view">
                    <span>{{ row.view }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="code">
                    <span>{{ row.code }}</span>
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

        <component v-bind:is="component.is" :props="component.prop" @on-close="closeComponent" @on-refresh="getLists"></component>
    </i-content>
</template>

<script>
    import IContent from "../../../../components/content/index";
    import ISearch from "../../../../components/content/search";
    import ITable from "../../../../components/content/table";
    import contentListPage from "../../../../mixins/content-list-page"
    import Create from './create'
    import Update from './update'

    export default {
        name: "index.vue",
        mixins: [contentListPage],
        components: {ITable, ISearch, IContent, Create, Update},
        data() {
            return {
                table: {
                    columns: [
                        {
                            title: '快递公司名称',
                            slot: 'name'
                        },
                        {
                            title: '是否支持查看物流信息',
                            slot: 'view'
                        },
                        {
                            title: '物流接口编号',
                            slot: 'code'
                        },
                        {
                            title: '操作',
                            slot: 'action'
                        }
                    ]
                }
            }
        },
        methods: {
            getLists(page){
                this.$http.get('setting/express/company', {
                    params: Object.assign({}, this.search, {page})
                }).then((data) => {
                    this.table.data = data.data;
                    this.page.total = data.total;
                    this.page.current = data.current_page;
                }).finally(()=> {this.loading = false;});
            },
            remove(row){
                this.loading = true;
                this.$http.delete(`setting/express/company/${row.id}`).then(() => {
                    this.getLists(1)
                }).finally(() => {
                    this.loading = false;
                })
            }
        }
    }
</script>

<style scoped>

</style>