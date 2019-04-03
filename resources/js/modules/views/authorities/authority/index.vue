<template>
    <i-content :spinShow="loading">
        <i-search v-model="search">
            <FormItem label="权限名称">
                <Input v-model="search.name" placeholder="权限名称"></Input>
            </FormItem>
            <FormItem label="请求URI">
                <Input v-model="search.uri" placeholder="URI"></Input>
            </FormItem>
            <FormItem :label-width="1">
                <Button type="primary" icon="ios-search" @click="getLists(1)">搜索</Button>
                <Button type="success" icon="ios-add" @click="openComponent('Create')">添加</Button>
            </FormItem>
        </i-search>

        <i-table :current="page.current" :total="page.total" @on-page-change="pageChange">
            <Table :columns="table.columns" :data="table.data">
                <template slot-scope="{ row, index }" slot="name">
                    <span>{{ row.name }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="uri">
                    <span>{{ row.uri }}</span>
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

        <component v-bind:is="component.is" :props="component.prop" @on-close="closeComponent" @on-refresh="getLists"></component>
    </i-content>
</template>

<script>
    import IContent from "../../../components/content/index";
    import ISearch from "../../../components/content/search";
    import ITable from "../../../components/content/table";
    import contentListPage from "../../../mixins/content-list-page";
    import Create from './create';
    import Update from './update';

    export default {
        name: "index",
        mixins: [contentListPage],
        components: {ITable, ISearch, IContent, Create, Update},
        data(){
            return {
                table: {
                    columns: [
                        {
                            title: '权限名称',
                            slot: 'name'
                        },
                        {
                            title: 'URI',
                            slot: 'uri'
                        },
                        {
                            title: '请求描述',
                            slot: 'description'
                        },
                        {
                            title: '操作',
                            slot: 'action'
                        }
                    ]
                },
                search: {}
            }
        },
        methods: {
            getLists(page = 1){
                this.loading = true;
                this.$http.get(`authorities/authority`, {
                    params: Object.assign({}, this.search, {page: page})
                }).then((data) => {
                    this.table.data = data.data
                    this.page.total = data.total
                    this.page.current = data.current_page
                }).finally(()=> {this.loading = false;});
            },
            remove(data){
                this.loading = true;
                this.$http.delete(`authorities/authority/${data.id}`)
                    .then(() => {this.getLists(this.page.current)});
            }
        }
    }
</script>

<style scoped>

</style>