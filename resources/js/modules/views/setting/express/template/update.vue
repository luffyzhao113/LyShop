<template>
    <i-drawer title="添加快递模板" :width="720" :loading="loading">
        <Form ref="formUpdate" :model="data" :label-width="100" :rules="ruleValidate">
            <FormItem label="模板名称" prop="name">
                <Input v-model="data.name"></Input>
            </FormItem>
            <Row>
                <Col span="12">
                    <FormItem label="模板类型" prop="type">
                        <RadioGroup v-model="data.type" type="button">
                            <Radio label="piece">按件收费</Radio>
                            <Radio label="weigh">按重量收费</Radio>
                        </RadioGroup>
                    </FormItem>
                </Col>

                <Col span="12">
                    <FormItem label="模板状态" prop="status">
                        <RadioGroup v-model="data.status" type="button">
                            <Radio label="on">开启</Radio>
                            <Radio label="off">关闭</Radio>
                        </RadioGroup>
                    </FormItem>
                </Col>

                <Col span="16">
                    <FormItem label="快递公司" prop="company_id">
                        <Select v-model="data.company_id">
                            <Option v-for="(val, index) in companies.data" :key="index" :value="val.id">{{val.name}}
                            </option>
                        </Select>
                    </FormItem>
                </Col>

                <Col span="24">
                    <FormItem label="模板说明" prop="description">
                        <Input v-model="data.description" type="textarea"></Input>
                    </FormItem>
                </Col>
            </Row>
            <Row class="express_details-box" :gutter="5">
                <div class="express_details-title">
                    <Col span="6">
                        <span class="item-required">*</span>
                        地区
                    </Col>
                    <Col span="4">
                        <span class="item-required">*</span>
                        首重(件)
                    </Col>
                    <Col span="4">
                        <span class="item-required">*</span>
                        首重(件)费用
                    </Col>
                    <Col span="4">
                        <span class="item-required">*</span>
                        续重(件)
                    </Col>
                    <Col span="4">
                        <span class="item-required">*</span>
                        续重(件)费用
                    </Col>
                    <Col span="2">
                        操作
                        <Poptip placement="top-end" width="410" transfer word-wrap trigger="hover">
                            <span slot="content">ceil(商品总重量(件) - 首重(件) / 续重(件)) * 续重(件)费用 = 续重(件)费用</span>
                            <Icon type="md-alert" size="16"/>
                        </Poptip>
                    </Col>
                </div>
                <template v-for="(item, index) in data.details">
                    <Col span="6" class="express_details-city">
                        <FormItem :prop="'details.' + index + '.areas'" :label-width="0"
                                  :rules="[{required: true, type: 'array', message: '城市必须选择', trigger: 'change'}]">
                            <Button size="small" type="dashed" @click="openAreasModal(index)"
                                    v-if="item.areas.length === 0">添加城市
                            </Button>
                            <template v-else>
                                <Tooltip placement="top" content="点击修改" theme="light" transfer style="width: 100%;">
                                    <div @click="openAreasModal(index)" class="areas-lists">
                                        <span> {{showAreaNames(item.areas)}} </span>
                                    </div>
                                </Tooltip>
                            </template>
                            <TriggerFormItem ref="details.areas"></TriggerFormItem>
                        </FormItem>
                    </Col>
                    <Col span="4">
                        <FormItem :prop="'details.' + index + '.first'" :label-width="0"
                                  :rules="[{required: true, type: 'number', message: '首重(件)必须填写', trigger: 'blur'}]">
                            <Input v-model="item.first" number></Input>
                        </FormItem>
                    </Col>
                    <Col span="4">
                        <FormItem :prop="'details.' + index + '.first_fee'" :label-width="0"
                                  :rules="[{required: true, type: 'number', message: '首重费用必须填写', trigger: 'blur'}]">
                            <Input v-model="item.first_fee" number></Input>
                        </FormItem>
                    </Col>
                    <Col span="4">
                        <FormItem :prop="'details.' + index + '.continue'" :label-width="0"
                                  :rules="[{required: true, type: 'number', message: '续重(件)必须填写', trigger: 'blur'}]">
                            <Input v-model="item.continue" number></Input>
                        </FormItem>
                    </Col>
                    <Col span="4">
                        <FormItem :prop="'details.' + index + '.continue_fee'" :label-width="0"
                                  :rules="[{required: true, type: 'number', message: '首重(件)费用必须填写', trigger: 'blur'}]">
                            <Input v-model="item.continue_fee" number></Input>
                        </FormItem>
                    </Col>
                    <Col span="2">
                        <FormItem :label-width="0">
                            <Button @click="remove(index)">删除</Button>
                        </FormItem>
                    </Col>
                </template>

                <Col offset="18" span="6">
                    <Button long size="small" @click="addAreaItem" type="dashed">添加一行</Button>
                </Col>
            </Row>
        </Form>

        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formUpdate')">提交</Button>
        </div>

        <Modal v-model="areas.modal" width="455">
            <p slot="header" style="color:#f60;text-align:center">
                <Icon type="ios-information-circle"></Icon>
                <span>城市列表</span>
            </p>
            <Transfer
                    :data="areas.data"
                    :target-keys="areas.wait"
                    :render-format="render"
                    :list-style="{height: '500px'}"
                    @on-change="handleChange"></Transfer>
            <div slot="footer">
                <Button type="primary" size="large" long @click="handleChangeOk">选择</Button>
            </div>
        </Modal>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../../components/content/drawer";
    import contentDrawer from '../../../../mixins/content-drawer'
    import TriggerFormItem from "./trigger-form-item.js";
    import template from "./template";

    export default {
        name: "update",
        components: {TriggerFormItem, IDrawer},
        mixins: [contentDrawer, template],
        mounted() {
            this.$http.get(`setting/express/template/${this.props.id}/edit`).then((res) => {
                this.companies.data = res.companies;
                this.areas.data = res.areas;
                this.data = res.row;
            }).finally(() => {
                this.loading = false;
            });
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.put(`setting/express/template/${this.props.id}`, this.data).then(() => {
                        this.closeDrawer(false);
                    }).finally(() => {
                        this.loading = false;
                    })
                })
            }
        }
    }
</script>

<style scoped lang="less">
    .express_details-box {
        .express_details-title {
            margin-bottom: 30px;
            text-align: center;
        }

        .express_details-city{
            text-align: center;
        }

        .areas-lists {
            padding: 0 5px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
        }

        .ivu-form-item {
            height: 32px;
        }
        .item-required{
            display: inline-block;
            margin-right: 4px;
            line-height: 1;
            font-family: SimSun;
            font-size: 12px;
            color: #ed4014;
        }
    }
</style>