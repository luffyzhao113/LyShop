<template>
    <Tree :data="treeData" show-checkbox multiple></Tree>
</template>

<script>
    export default {
        name: "l-tree",
        props: {
            value: {
                type: Array,
                default: () => []
            },
            data: {
                type: Array,
                default: () => []
            },
            parentId: {
                type: String,
                default: 'parent_id'
            },
            id: {
                type: String,
                default: 'id'
            },
            children: {
                type: String,
                default: 'children'
            },
            containParent: {
                type: Boolean,
                default: false
            }
        },
        data(){
            return {
                treeData:this.setTreeData(this.data)
            }
        },
        methods: {
            setTreeData(source) {
                let cloneData = JSON.parse(JSON.stringify(source));
                return cloneData.map((item) => {
                    return Object.assign(item, {expand: true, checked: this.checked(item)});
                }).filter(father => {
                    let branchArr = cloneData.filter(child => {
                        return father[this.id] === child[this.parentId]
                    });
                    if (branchArr.length > 0) {
                        father[this.children] = branchArr
                    }
                    return Number(father[this.parentId]) === 0
                });
            },
            checked(item){
                let children = this.data.find(child => {
                    return item[this.id] === child[this.parentId]
                });
                return Boolean(this.value.find(val => val === item[this.id])) && children === undefined;
            },
            hasChild(parent) {
                return parent[this.children] && parent[this.children].length > 0
            },
            toChecked(data) {
                let arr = [];
                data.forEach((item) => {
                    if (item.indeterminate === true || item.checked === true) {
                        if(this.containParent === true && this.hasChild(item) && (item.checked === true || item.indeterminate)){
                            arr.push(item[this.id]);
                        }else if (!this.hasChild(item) && item.checked === true) {
                            arr.push(item[this.id]);
                        }

                        if (this.hasChild(item)) {
                            arr = arr.concat(this.toChecked(item[this.children]));
                        }
                    }
                });
                return arr
            }
        },
        watch: {
            treeData: {
                deep: true,
                handler(val, oldVal) {
                    this.$emit('input', this.toChecked(val))
                }
            },
            data: {
                deep: true,
                handler(val, oldVal) {
                    this.treeData = this.setTreeData(val)
                }
            }
        }
    }
</script>

<style scoped>

</style>