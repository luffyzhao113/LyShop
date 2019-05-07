<template>
    <i-content :spin-show="loading">
        <i-search>
            <FormItem label="名称">
                <Input v-model="search.name" placeholder="名称"></Input>
            </FormItem>
            <FormItem label="类型">
                <iSelect v-model="search.type" clearable>
                    <Option value="attr">属性</Option>
                    <Option value="spec">规格</Option>
                </iSelect>
            </FormItem>
            <FormItem :label-width="1">
                <Button type="primary" icon="ios-search" @click="getLists(1)">搜索</Button>
                <Button type="success" icon="ios-add" @click="openComponent('Create')">添加</Button>
            </FormItem>
        </i-search>
        <i-table :current="page.current" :total="page.total" @on-page-change="pageChange">
            <Table :columns="table.columns" :data="table.data">
                <template slot-scope="{ row, index }" slot="name">
                    <span>{{row.name}}</span>
                </template>
                <template slot-scope="{ row, index }" slot="type">
                    <span>{{row.type | type}}</span>
                </template>
                <template slot-scope="{ row, index }" slot="description">
                    <span>{{row.description}}</span>
                </template>
                <template slot-scope="{ row, index }" slot="values">
                    <span>{{row.values | values}}</span>
                </template>
                <template slot-scope="{ row, index }" slot="action">
                    <Button type="warning" size="small" @click="openComponent('Update', row)">编辑</Button>
                    <Poptip
                            confirm
                            title="你确定要删除这个商品属性吗？"
                            @on-ok="remove(row)">
                        <Button type="error" size="small">删除</Button>
                    </Poptip>
                </template>
            </Table>
        </i-table>

        <component v-bind:is="component.is" :props="component.prop" @on-close="closeComponent" @on-refresh="getLists(1)"></component>
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
                loading: false,
                table: {
                    columns: [{
                        title: '名称',
                        slot: 'name'
                    }, {
                        title: '类型',
                        slot: 'type'
                    }, {
                        title: '值',
                        slot: 'values'
                    }, {
                        title: '描述',
                        slot: 'description'
                    },{
                        title: '操作',
                        slot: 'action'
                    },]
                },
                search: {}
            }
        },
        methods: {
            getLists(page){
                this.loading = true;
                this.$http.get(`goods/spec`, {
                    params: Object.assign({}, this.search, {page: page})
                }).then((data) => {
                    this.table.data = data.data
                    this.page.total = data.total
                    this.page.current = data.current_page
                }).finally(() => {
                    this.loading = false
                })
            },
            remove(row){
                this.loading = true
                this.$http.delete(`goods/spec/${row.id}`).then(() => {
                    this.getLists(this.page.current)
                }).catch(() => {
                    this.loading = false
                })
            }
        },
        filters: {
            values(val){
                return val.join(',')
            },
            type(val){
                return val === 'attr' ? '属性' : '规格' ;
            }
        }
    }
</script>

<style scoped>

</style>