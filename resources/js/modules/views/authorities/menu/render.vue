<template>
    <span class="tree-li">
        <span>
            <Icon :type="data.children && data.children.length > 0 ? 'ios-folder-outline' : 'ios-paper-outline'"></Icon>
            <span>
                <Tooltip :content="data.description" placement="right">
                {{ data.name }}
                </Tooltip>
            </span>
        </span>
        <span class="tree-li-buttons">
            <template v-if="parent">
                <Button type="primary" size="small" icon="ios-add" style="width: 65px" @click="append(data)"></Button>
            </template>
            <template v-else>
                <Button type="warning" size="small" icon="md-checkmark-circle-outline"
                        @click="append(data, 'update')"></Button>
                <Button type="primary" size="small" icon="ios-add" @click="append(data)"></Button>
                <Poptip
                        confirm
                        title="你确定要删除这个菜单吗？"
                        @on-ok="remove(data)">
                    <Button v-if="!(data.children && data.children.length > 0)" type="error" size="small"
                            icon="ios-remove"></Button>
                </Poptip>
            </template>
        </span>
    </span>
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
        display: inline-block;
        width: 100%;
        font-size: 14px;

        .tree-li-buttons {
            display: inline-block;
            float: right;
            margin-right: 32px
        }
    }
</style>