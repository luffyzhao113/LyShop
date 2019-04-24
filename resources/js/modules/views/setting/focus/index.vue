<template>
    <i-content :spin-show="false">
        <i-search>
            <FormItem :label-width="1">
                <Button type="primary" icon="ios-search" @click="getLists(1)">搜索</Button>
                <Button type="success" icon="ios-add" @click="openComponent('Create')">添加</Button>
                <Button type="info" @click="openRoute('setting.focus.position')">焦点图位置管理</Button>
            </FormItem>
        </i-search>
        <i-table></i-table>
    </i-content>
</template>

<script>
    import IContent from "../../../components/content/index";
    import ISearch from "../../../components/content/search";
    import ITable from "../../../components/content/table";
    import contentListPage from "../../../mixins/content-list-page"

    export default {
        name: "index",
        mixins: [contentListPage],
        components: {ITable, ISearch, IContent}
    }
</script>

<style scoped>

</style>