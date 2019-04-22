<template>
    <i-drawer title="添加快递模板" :width="720" :loading="loading">
        <Form ref="formCreate" :model="create" :label-width="100" :rules="ruleValidate">
            <FormItem label="模板名称" prop="name">
                <Input v-model="create.name"></Input>
            </FormItem>
            <Row>
                <Col span="12">
                    <FormItem label="模板类型" prop="type">
                        <RadioGroup v-model="create.type" type="button">
                            <Radio label="piece">按件收费</Radio>
                            <Radio label="weigh">按重量收费</Radio>
                        </RadioGroup>
                    </FormItem>
                </Col>

                <Col span="12">
                    <FormItem label="模板状态" prop="status">
                        <RadioGroup v-model="create.status" type="button">
                            <Radio label="on">开启</Radio>
                            <Radio label="off">关闭</Radio>
                        </RadioGroup>
                    </FormItem>
                </Col>

                <Col span="16">
                    <FormItem label="快递公司" prop="company_id">
                        <Select v-model="create.company_id">
                            <Option v-for="(val, index) in companies.data" :key="index" :value="val.id">{{val.name}}
                            </option>
                        </Select>
                    </FormItem>
                </Col>

                <Col span="24">
                    <FormItem label="模板说明" prop="description">
                        <Input v-model="create.description" type="textarea"></Input>
                    </FormItem>
                </Col>
            </Row>
            <Row class="express_details-box" :gutter="5">
                <div class="express_details-title">
                    <Col span="6">
                        地区
                    </Col>
                    <Col span="4">
                        首重
                    </Col>
                    <Col span="4">
                        首重费用
                    </Col>
                    <Col span="4">
                        续重
                    </Col>
                    <Col span="4">
                        续重费用
                    </Col>
                    <Col span="2">
                        操作
                    </Col>
                </div>
                <template v-for="(item, index) in create.details">
                    <Col span="6">
                        <FormItem :prop="'details.' + index + 'areas'" :label-width="0">
                            <Button size="small" type="dashed" v-if="item.areas.length === 0">添加地区</Button>
                            <template v-for="(area, key) in item.areas">
                                <span> {{area}} </span>
                            </template>
                        </FormItem>
                    </Col>
                    <Col span="4">
                        <FormItem :prop="'details.' + index + 'first'" :label-width="0">
                            <Input v-model="item.first"></Input>
                        </FormItem>
                    </Col>
                    <Col span="4">
                        <FormItem :prop="'details.' + index + 'first_fee'" :label-width="0">
                            <Input v-model="item.first_fee"></Input>
                        </FormItem>
                    </Col>
                    <Col span="4">
                        <FormItem :prop="'details.' + index + 'continue'" :label-width="0">
                            <Input v-model="item.continue"></Input>
                        </FormItem>
                    </Col>
                    <Col span="4">
                        <FormItem :prop="'details.' + index + 'continue_fee'" :label-width="0">
                            <Input v-model="item.continue_fee"></Input>
                        </FormItem>
                    </Col>
                    <Col span="2">
                        <FormItem :label-width="0">
                            <Button>删除</Button>
                        </FormItem>
                    </Col>
                </template>

                <Col offset="18" span="6">
                    <Button long size="small" @click="addAreaItme" type="dashed">添加一行</Button>
                </Col>
            </Row>
        </Form>

        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formCreate')">提交</Button>
        </div>

        <Modal v-model="modal2" width="360">
        </Modal>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../../components/content/drawer";
    import contentDrawer from '../../../../mixins/content-drawer'

    export default {
        name: "create",
        components: {IDrawer},
        mixins: [contentDrawer],
        data() {
            return {
                loading: false,
                create: {
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
                areas: {data: []},
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
            this.$http.get(`setting/express/template/create`).then((res) => {
                this.companies.data = res.companies
            })
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.$http.post(`setting/express/template`, this.create).then((res) => {
                        console.log(res)
                    });
                })
            },
            addAreaItme(){
                this.create.details.push({
                    areas: [],
                    first: 0.00,
                    first_fee: 0.00,
                    continue: 0.00,
                    continue_fee: 0.00,
                });
            }
        }
    }
</script>

<style scoped lang="less">
.express_details-box{
    .express_details-title{
        margin-bottom: 30px;
    }
    .ivu-col{
        text-align: center;
    }
}
</style>