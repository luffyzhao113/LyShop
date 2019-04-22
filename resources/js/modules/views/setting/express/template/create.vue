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

                <Col span="16                                                                                                                                                                      ">
                    <FormItem label="快递公司名称" prop="company_id">
                        <Select v-model="create.company_id">
                            <!--<Option></option>-->
                        </Select>
                    </FormItem>
                </Col>

            </Row>

            <FormItem label="模板说明" prop="description">
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
        components: {IDrawer},
        mixins: [contentDrawer],
        data() {
            return {
                loading: false,
                create: {
                    view: 'no',
                    status: 'off',
                    type: 'piece',
                    company_id: undefined
                },
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
                            message: '快递公司必须选择'
                        }
                    ],
                }
            }
        },
        methods: {
            submit(name){
                this.validate(name).then(() => {
                    this.$http.post(`setting/express`, this.create).then((res) => {
                        console.log(res)
                    });
                })
            }
        }
    }
</script>

<style scoped>

</style>