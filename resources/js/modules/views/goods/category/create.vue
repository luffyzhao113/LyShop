<template>
    <i-drawer title="添加类目" :loading="loading">
        <Form ref="formCreate" :model="data" :label-width="80" :rules="ruleValidate">
            <FormItem label="名称" prop="name">
                <Input v-model="data.name"></Input>
            </FormItem>
            <Row>
                <Col span="8">
                    <FormItem label="上级类目" prop="parent_id">
                        <Input :value="props.name" disabled></Input>
                    </FormItem>
                </Col>
                <Col span="8">
                    <FormItem label="排序" prop="sort">
                        <Input v-model="data.sort" number></Input>
                    </FormItem>
                </Col>

                <Col span="8">
                    <FormItem label="状态" prop="status">
                        <i-switch v-model="data.status" true-value="on" false-value="off">
                            <span slot="open">开</span>
                            <span slot="close">关</span>
                        </i-switch>
                    </FormItem>
                </Col>
            </Row>

            <Row class="search_filters-box" :gutter="10">
                <Col span="4" align="center">
                    <span class="item-required">*</span>搜索属性名
                </Col>
                <Col span="18" align="center">
                    <span class="item-required">*</span>搜索属性值
                </Col>
                <Col span="2" align="center">
                    操作
                </Col>
                <Col span="24">
                    <Row v-for="(item, index) in data.search_filters" :key="index" :gutter="10">
                        <Col span="4" align="center">
                            <FormItem :label-width="0" :rules="[{required: true, message: '属性名必须填写'}]" :prop="'search_filters.'+index+'.name'">
                                <Input v-model="item.name" size="small"></Input>
                            </FormItem>
                        </Col>
                        <Col span="18" align="left">
                            <FormItem :label-width="0" :rules="[{required: true, type:'array', message: '属性值必须填写'}]">
                                <Tag closable v-for="(val, key) in item.values" :key="key"
                                     @on-close="close(item.values, key)">{{val}}
                                </Tag>
                                <Button type="dashed" @click="add(index)" size="small">添加搜索属性值</Button>
                            </FormItem>
                        </Col>
                        <Col span="2" align="center">
                            <FormItem :label-width="0">
                                <Button @click="remove(data.search_filters, index)" size="small">删除</Button>
                            </FormItem>
                        </Col>
                    </Row>
                </Col>
                <Col offset="18" span="6">
                    <FormItem :label-width="0">
                        <Button long size="small" @click="addAreaItem(data.search_filters)" type="dashed">添加一行
                        </Button>
                    </FormItem>
                </Col>
            </Row>

            <FormItem label="模板说明" prop="description">
                <Input v-model="data.description" type="textarea" :rows="4"></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formCreate')">提交</Button>
        </div>
        <Modal v-model="filter.show">
            <p slot="header" style="color:#f60;text-align:center">
                <Icon type="ios-information-circle"></Icon>
                <span>添加属性值</span>
            </p>
            <Input v-model="filter.value" @on-enter="handleChangeOk"></Input>
            <div slot="footer">
                <Button type="primary" size="large" long @click="handleChangeOk">添加</Button>
            </div>
        </Modal>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../components/content/drawer";
    import contentDrawer from '../../../mixins/content-drawer'
    import {oneOf} from 'iview/src/utils/assist';
    import category from "./category";

    export default {
        name: "create",
        mixins: [contentDrawer, category],
        components: {IDrawer},
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.post(`goods/category`, this.data).then(() => {
                        this.closeDrawer(false)
                    }).finally(() => {
                        this.loading = false
                    });
                })
            }
        }
    }
</script>

<style lang="less">
.search_filters-box{
    .item-required{
        display: inline-block;
        margin-right: 4px;
        line-height: 1;
        font-family: SimSun;
        font-size: 12px;
        color: #ed4014;
    }
    .ivu-form-item{
        margin-bottom: 10px;
        .ivu-form-item-error-tip{
            padding-top: 0px;
        }
    }
}
</style>