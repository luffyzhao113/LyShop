<template>
    <i-drawer title="添加快递模板" :width="720" :loading="loading">
        <Form ref="formUpdate" :model="update" :label-width="100" :rules="ruleValidate">
            <FormItem label="模板名称" prop="name">
                <Input v-model="update.name"></Input>
            </FormItem>
            <Row>
                <Col span="12">
                    <FormItem label="模板类型" prop="type">
                        <RadioGroup v-model="update.type" type="button">
                            <Radio label="piece">按件收费</Radio>
                            <Radio label="weigh">按重量收费</Radio>
                        </RadioGroup>
                    </FormItem>
                </Col>

                <Col span="12">
                    <FormItem label="模板状态" prop="status">
                        <RadioGroup v-model="update.status" type="button">
                            <Radio label="on">开启</Radio>
                            <Radio label="off">关闭</Radio>
                        </RadioGroup>
                    </FormItem>
                </Col>

                <Col span="16">
                    <FormItem label="快递公司" prop="company_id">
                        <Select v-model="update.company_id">
                            <Option v-for="(val, index) in companies.data" :key="index" :value="val.id">{{val.name}}
                            </option>
                        </Select>
                    </FormItem>
                </Col>

                <Col span="24">
                    <FormItem label="模板说明" prop="description">
                        <Input v-model="update.description" type="textarea"></Input>
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
                <template v-for="(item, index) in update.details">
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

    export default {
        name: "update",
        components: {TriggerFormItem, IDrawer},
        mixins: [contentDrawer],
        data() {
            return {
                loading: true,
                update: {
                    view: 'no',
                    status: 'off',
                    type: 'piece',
                    company_id: undefined,
                    details: [
                        {
                            areas: [],
                            first: 0.00,
                            first_fee: 0.00,
                            continue: 0.00,
                            continue_fee: 0.00,
                        }
                    ]
                },
                areas: {data: [], modal: false, index: undefined, wait: []},
                companies: {data: []},
                ruleValidate: {
                    name: [
                        {required: true, message: '模板名称必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 50, message: '模板名称字符长度是2-50个字符', trigger: 'blur'}
                    ],
                    type: [
                        {required: true, message: '模板类型必须选择', trigger: 'change'}
                    ],
                    status: [
                        {required: true, message: '模板状态必须选择', trigger: 'change'}
                    ],
                    company_id: [
                        {
                            trigger: 'change',
                            required: true,
                            type: 'number',
                            message: '快递公司必须选择'
                        }
                    ],
                }
            }
        },
        mounted() {
            this.$http.get(`setting/express/template/${this.props.id}/edit`).then((res) => {
                this.companies.data = res.companies;
                this.areas.data = res.areas;
                this.update = res.row;
            }).finally(() => {
                this.loading = false;
            });
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.put(`setting/express/template/${this.props.id}`, this.update).then(() => {
                        this.closeDrawer(false);
                    }).finally(() => {
                        this.loading = false;
                    })
                })
            },
            addAreaItem() {
                this.update.details.push({
                    areas: [],
                    first: 0.00,
                    first_fee: 0.00,
                    continue: 0.00,
                    continue_fee: 0.00,
                });
            },
            remove(item) {
                this.update.details.splice(item, 1);
            },
            openAreasModal(index) {
                this.areas.index = index;
                this.areas.wait = this.update.details[this.areas.index].areas;
                this.updateAreas(index);
                this.areas.modal = true;
            },
            render(item) {
                return item.label;
            },
            showAreaName(id) {
                return this.areas.data.find(val => val.key === id)['label'];
            },
            showAreaNames(items) {
                if (items.length > 2) {
                    return this.showAreaName(items[0]) + ` 等 ${items.length} 个城市`;
                } else if (items.length > 0) {
                    let str = '';
                    items.forEach(val => {
                        str += ' ' + this.showAreaName(val) + ',';
                    });
                    return str.substr(0, str.length - 1);
                }
            },
            handleChange(newTargetKeys) {
                this.areas.wait = newTargetKeys;
            },
            handleChangeOk() {
                this.update.details[this.areas.index].areas = this.areas.wait;
                this.areas.modal = false;
                this.$refs['details.areas'][this.areas.index].trigger(this.update.details[this.areas.index].areas)
            },
            updateAreas(index) {
                let changeAreas = [];
                this.update.details.forEach(({areas}, key) => {
                    if (index !== key)
                        changeAreas = changeAreas.concat(areas);
                });
                this.areas.data.map((item, index) => {
                    if (changeAreas.find(val => item.key === val)) {
                        item.disabled = true;
                    } else {
                        item.disabled = false
                    }
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