<template>
    <i-content :spinShow="loading">
        <Card>
            <Tree :data="data" :render="renderContent"></Tree>
        </Card>

        <component v-bind:is="component.is" :props="component.prop" @on-close="closeComponent" @on-refresh="getLists"></component>
    </i-content>
</template>

<script>
    import IContent from "../../../components/content/index";
    import contentListPage from "../../../mixins/content-list-page";
    import render from './render'
    import create from './create'
    import update from './update'

    export default {
        name: "index",
        mixins: [contentListPage],
        components: {IContent, render, create, update},
        data() {
            return {
                data: [{
                    id: 0,
                    name: '顶级菜单',
                    expand: true,
                    children: []
                }]
            }
        },
        methods: {
            getLists() {
                this.loading = true;
                this.$http.get(`authorities/menu`).then((data) => {
                    this.data[0].children = this.setTreeData(data);
                }).finally(()=> {this.loading = false;});
            },
            renderContent(h, {root, node, data}) {
                return h(render, {
                    props: {
                        root, node, data, parent: data.id === 0
                    },
                    on: {
                        'on-append': this.append,
                        'on-remove': this.remove,
                    }
                });
            },
            append(data, com = 'create') {
                this.openComponent(com, data);
            },
            remove(data) {
                this.loading = true;
                this.$http.delete(`authorities/menu/${data.id}`)
                .then((res) =>{
                    this.getLists();
                });
            },
            setTreeData(source) {
                let cloneData = JSON.parse(JSON.stringify(source))
                let tree = cloneData.filter(father => {
                    let branchArr = cloneData.filter(child => {
                        return father['id'] == child['parent_id']
                    });
                    if (branchArr.length > 0) {
                        father['children'] = branchArr
                    }
                    return father['parent_id'] == 0
                })
                return tree
            }
        }
    }
</script>

<style scoped>

</style>