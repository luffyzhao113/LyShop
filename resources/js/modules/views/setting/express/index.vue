<template>
    <i-content :spin-show="!loading">
        <i-search></i-search>
        <i-table>
            <Table :columns="table.columns" :data="table.data">
            </Table>
        </i-table>
    </i-content>
</template>

<script>
    import IContent from "../../../components/content/index";
    import contentListPage from "../../../mixins/content-list-page"
    import ISearch from "../../../components/content/search";
    import ITable from "../../../components/content/table";

    export default {
        name: "index",
        mixins: [contentListPage],
        components: {ITable, ISearch, IContent},
        data(){
            return {
                table: {
                    columns: [
                        {
                            title: '模板名称',
                            slot: 'name'
                        },
                        {
                            title: '收费类型',
                            slot: 'type'
                        },
                        {
                            title: '模板说明',
                            slot: 'description'
                        },
                        {
                            title: '是否接入快递100',
                            slot: 'view'
                        },
                        {
                            title: '快递100编码',
                            slot: 'com'
                        },
                        {
                            title: '操作',
                            slot: 'action'
                        }
                    ]
                },
                search: {}
            }
        }
    }
</script>

<style scoped>

</style>