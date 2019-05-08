<template>
    <i-content :spin-show="loading">
        <Card>
            <Tree :data="data" :render="renderContent"></Tree>
        </Card>

        <component v-bind:is="component.is" :props="component.prop" @on-close="closeComponent"
                   @on-refresh="getLists"></component>
    </i-content>
</template>

<script>
    import IContent from "../../../components/content/index";
    import contentListPage from "../../../mixins/content-list-page"
    import Create from './create'
    import Update from './update'
    import render from './render'

    export default {
        name: "index",
        mixins: [contentListPage],
        components: {IContent, Create, Update},
        data() {
            return {
                loading: false,
                data: [{
                    id: '0',
                    name: '顶级类目',
                    expand: true,
                    children: []
                }]
            }
        },
        methods: {
            getLists() {
                this.loading = true;
                this.$http.get(`goods/category`).then((data) => {
                    this.data[0].children = this.setTreeData(data);
                }).finally(() => {
                    this.loading = false;
                });
            },
            renderContent(h, {root, node, data}) {
                return h(render, {
                    props: {
                        root, node, data, parent: data.id === '0'
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
                this.$http.delete(`goods/category/${data.id}`)
                    .then((res) => {
                        this.getLists();
                    }).finally(() => {
                    this.loading = false;
                });
            },
            setTreeData(source) {
                let cloneData = JSON.parse(JSON.stringify(source));
                return cloneData.map((val) => {
                    val.expand = true;
                    return val;
                }).filter(father => {
                    let branchArr = cloneData.filter(child => {
                        return father['id'] === child['parent_id']
                    });
                    if (branchArr.length > 0) {
                        father['children'] = branchArr
                    }
                    return father['parent_id'] === "0"
                });
            }
        }
    }
</script>