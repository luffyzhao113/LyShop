<template>
    <i-content>
        <i-search></i-search>

        <i-table :current="page.current" :total="page.total" @on-page-change="pageChange">
            <Table :columns="table.columns" :data="table.data">
                <template slot-scope="{ row, index }" slot="name">
                    <span>{{ row.name }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="sort">
                    <span>{{ row.sort }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="values">
                    <span>{{ row.values }}</span>
                </template>
                <template slot-scope="{ row, index }" slot="action">
                    <Button type="warning" size="small">编辑</Button>
                    <Button type="error" size="small">删除</Button>
                </template>
            </Table>
        </i-table>

    </i-content>
</template>

<script>
    import ISearch from "../../../components/content/search";
    import IContent from "../../../components/content/index";
    import ITable from "../../../components/content/table";
    import contentTable from "../../../mixins/content-list-page"

    export default {
        name: "index",
        mixins: [contentTable],
        components: {ITable, IContent, ISearch},
        data(){
            return {
                table: {
                    columns: [
                        {
                            title: '规格名称',
                            slot: 'name'
                        },
                        {
                            title: '规格排序',
                            slot: 'sort'
                        },
                        {
                            title: '规格值',
                            slot: 'values'
                        },
                        {
                            title: '操作',
                            slot: 'action'
                        }
                    ]
                }
            }
        }
    }
</script>

<style scoped lang="less">
</style>