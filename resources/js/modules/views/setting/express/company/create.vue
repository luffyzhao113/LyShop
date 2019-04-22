<template>
    <i-drawer title="添加快递公司" :width="720" :loading="loading">
        <Form ref="formCreate" :model="create" :label-width="100" :rules="ruleValidate">
            <FormItem label="快递公司名称" prop="name">
                <Input v-model="create.name"></Input>
            </FormItem>
            <Row>
                <Col span="12">
                    <FormItem label="查看物流轨迹" prop="view">
                        <RadioGroup v-model="create.view" type="button">
                            <Radio label="yes">支持</Radio>
                            <Radio label="no">不支持</Radio>
                        </RadioGroup>
                    </FormItem>
                </Col>

                <Col span="12">
                    <FormItem prop="code">
                        <span slot="label">
                            物流编号
                            <Tooltip placement="top">
                                <span slot="content">快递公司标准国际编码.</span>
                                <Icon type="md-alert" size="16"/>
                            </Tooltip>
                        </span>
                        <Input v-model="create.code"></Input>
                    </FormItem>
                </Col>
            </Row>
            <FormItem label="快递公司简介" prop="description">
                <Input v-model="create.description" type="textarea" :rows="6"></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formCreate')">提交</Button>
        </div>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../../components/content/drawer";
    import contentDrawer from '../../../../mixins/content-drawer'

    export default {
        name: "create",
        mixins: [contentDrawer],
        components: {IDrawer},
        data() {
            return {
                loading: false,
                create: {
                    view: 'no',
                    code: ''
                },
                ruleValidate: {
                    name: [
                        {required: true, message: '快递公司名称必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 50, message: '快递公司名称字符长度是2-50个字符', trigger: 'blur'}
                    ],
                    view: [
                        {required: true, message: '是否支持查看物流轨迹必须选择', trigger: 'change'},
                    ],
                    code: [
                        {
                            validator: (rule, value, callback) => {
                                if ((this.create.view === 'yes' && value !== '') || this.create.view === 'no') {
                                    return callback();
                                } else {
                                    return callback('物流接口编号必须填写');
                                }
                            }, message: '物流接口编号必须填写', trigger: 'blur'
                        }
                    ],
                    description: [
                        {max: 255, message: '快递公司简介最多支持255个字符', trigger: 'blur'}
                    ]
                }
            }
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true
                    this.$http.post(`setting/express/company`, this.create).then((res) => {
                        this.closeDrawer(false)
                    }).finally(() => {
                        this.loading = false
                    });
                })
            }
        }
    }
</script>

<style scoped>

</style>