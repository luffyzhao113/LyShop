<template>
    <div class="tree-li">
        <span class="tree-li-span">
            <Icon :type="data.children && data.children.length > 0 ? 'ios-folder-outline' : 'ios-paper-outline'"></Icon>
            <span>
                {{ data.name }}
            </span>
        </span>
        <span class="tree-li-buttons">
            <template v-if="parent">
                <Button type="dashed" size="small" icon="ios-add" style="width: 90px" @click="append(data)"></Button>
            </template>
            <template v-else>
                <Button type="dashed" size="small" icon="ios-checkmark-circle-outline"
                        @click="append(data, 'update')"></Button>
                <Button type="dashed" size="small" icon="ios-add" @click="append(data)"></Button>
                <Poptip
                        confirm
                        title="你确定要删除这个类目吗？"
                        @on-ok="remove(data)">
                    <Button v-if="!(data.children && data.children.length > 0)" type="dashed" size="small"
                            icon="ios-remove"></Button>
                    <Button v-else icon="ios-remove" disabled size="small"></Button>
                </Poptip>
            </template>
        </span>
    </div>
</template>

<script>
    export default {
        name: "render",
        props: ['root', 'node', 'data', 'parent'],
        methods: {
            append(data, com = 'create') {
                this.$emit('on-append', data, com);
            },
            remove(data) {
                this.$emit('on-remove', data);
            }
        }
    }
</script>

<style scoped lang="less">
    .tree-li {
        display: inline-flex;
        width: 100%;
        font-size: 14px;


        .tree-li-buttons {
            margin-right: 32px;
            padding-left: 10px;
            flex-basis: 100px;
        }

        .tree-li-span{
            flex: 1;
        }

        &:hover{
            .tree-li-span{
                border-bottom: 1px dashed #dcdee2;
            }
        }
    }
</style>