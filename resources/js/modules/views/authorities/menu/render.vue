<template>
    <span class="tree-li">
        <Row class="tree-li-a" v-if="data.id != '0'">
            <Col :span="4" offset="8">{{data.url}}</Col>
            <Col :span="4">{{data.sort}}</Col>
            <Col :span="4">{{data.description == '' ? data.description : '-'}}</Col>
            <Col :span="4">
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
            <Col :span="4" offset="8">菜单url</Col>
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
        display: inline-flex;
        width: 100%;
        font-size: 14px;
        vertical-align: top;
        position: initial;
        .tree-li-a{
            position: absolute;
            left: 0;
            width: 100%;
            &:hover{
                background-color: #ebf7ff;
            }
            .ivu-col{
                z-index: 6;
            }
        }
    }
</style>