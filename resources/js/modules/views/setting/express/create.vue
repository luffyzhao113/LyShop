<template>
    <i-drawer title="添加快递模板" :width="720" :loading="loading"></i-drawer>
</template>

<script>
    import IDrawer from "../../../components/content/drawer";
    import contentDrawer from '../../../mixins/content-drawer'

    export default {
        name: "create",
        components: {IDrawer},
        mixins: [contentDrawer],
        data(){
            return {
                loading: false
            }
        }
    }
</script>

<style scoped>

</style>