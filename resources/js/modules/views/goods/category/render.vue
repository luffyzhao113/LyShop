<template>
    <Row class="tree-li">
        <Col span="20">
            <Icon :type="data.children && data.children.length > 0 ? 'ios-folder-outline' : 'ios-paper-outline'"></Icon>
            <Poptip placement="right" trigger="hover" width="400" v-if="!parent">
                <div v-if="data.status === 'on'" class="hand" >{{ data.name }}</div>
                <del v-else class="hand" style="color: #c3cbd6">{{ data.name }}</del>
                <div class="api" slot="content">
                    <Row>
                        <Col :span="8">状态</Col>
                        <Col :span="8">排序</Col>
                        <Col :span="8">描述</Col>
                        <Col :span="8">{{data.status|status}}</Col>
                        <Col :span="8">{{data.sort}}</Col>
                        <Col :span="8">{{data.description}}</Col>
                    </Row>
                </div>
            </Poptip>
            <span v-else>{{ data.name }}</span>
        </Col>
        <Col span="4">
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
    }
    .hand{
        cursor:pointer
    }
</style>