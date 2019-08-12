<template>
    <Row class="tree-li">
        <Row class="tree-li-a" v-if="data.id != '0'">
            <Col :span="4" offset="8">{{data.status|status}}</Col>
            <Col :span="4">{{data.sort}}</Col>
            <Col :span="4">{{data.description == '' ? data.description : '-'}}</Col>
            <Col :span="4" class="tree-li-action">
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
            </Col>
        </Row>
        <Row class="tree-li-a" v-else>
            <Col :span="4" offset="8">状态</Col>
            <Col :span="4">排序</Col>
            <Col :span="4">说明</Col>
            <Col :span="4" class="tree-li-action">
                <Button type="dashed" size="small" icon="ios-add" style="width: 90px" @click="append(data)"></Button>
            </Col>
        </Row>
        <Col span="24">
            <Icon :type="data.children && data.children.length > 0 ? 'ios-folder-outline' : 'ios-paper-outline'"></Icon>
            <span class="hand" >{{ data.name }}</span>
        </Col>
    </Row>
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
        },
        filters: {
            status(v) {
                if (v === 'on')return '开启';
                if (v === 'off')return '关闭';
            }
        }
    }
</script>

<style scoped lang="less">
    .tree-li {
        display: inline-flex;
        width: 100%;
        font-size: 14px;
        vertical-align: top;
        position: initial;
    }
    .hand{
        cursor:pointer
    }
    .tree-li-a{
        position: absolute;
        left: 0;
        width: 100%;
    }
    .tree-li-action{
        z-index: 6;
    }
</style>

<style>
    .ivu-tree .ivu-tree-arrow{
        z-index: 6;
        position: relative;
    }
</style>