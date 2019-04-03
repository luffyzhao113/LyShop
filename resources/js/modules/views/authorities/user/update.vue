<template>
    <i-drawer title="用户添加" :width="620" :loading="loading">
        <Form :model="update" :label-width="100" :rules="ruleValidate" ref="formUpdate">
            <FormItem label="姓名" prop="name">
                <Input placeholder="请输入姓名" v-model="update.name"></Input>
            </FormItem>
            <FormItem label="邮箱" prop="email">
                <Input placeholder="请输入邮箱" v-model="update.email"></Input>
            </FormItem>

            <Row>
                <Col span="12">
                    <FormItem label="手机号码" prop="phone">
                        <Input placeholder="手机号码" v-model="update.phone"></Input>
                    </FormItem>
                </Col>
                <Col span="12">
                    <FormItem label="用户状态" prop="status">
                        <i-switch true-value="on" false-value="off" v-model="update.status" size="large">
                            <span slot="open">开启</span>
                            <span slot="close">关闭</span>
                        </i-switch>
                    </FormItem>
                </Col>
            </Row>
            <Row>
                <Col span="12">
                    <FormItem label="出生日期" prop="birthday">
                        <DatePicker placeholder="出生日期" :value="update.birthday" format="yyyy-MM-dd" @on-change="(val) => update.birthday = val"></DatePicker>
                    </FormItem>
                </Col>
                <Col span="12">
                    <FormItem label="用户性别" prop="sex">
                        <i-switch true-value="man" false-value="women" v-model="update.sex" size="large">
                            <span slot="open">男</span>
                            <span slot="close">女</span>
                        </i-switch>
                    </FormItem>
                </Col>
            </Row>
            <Row>
                <Col span="12">
                    <FormItem label="入职时间" prop="entryday">
                        <DatePicker placeholder="入职时间" :value="update.entryday" format="yyyy-MM-dd" @on-change="(val) => update.entryday = val"></DatePicker>
                    </FormItem>
                </Col>
                <Col span="12">
                    <FormItem label="所属部门" prop="department_id">
                        <Select v-model="update.department_id">
                            <Option v-for="(item) in departments.data" :key="item.id" :value="item.id">
                                {{item.name}}
                            </Option>
                        </Select>
                    </FormItem>
                </Col>
            </Row>

            <FormItem label="密码" prop="password">
                <Input placeholder="请输入密码" type="password" v-model="update.password"></Input>
            </FormItem>
            <FormItem label="确认密码" prop="password_confirmation">
                <Input placeholder="请输入确认密码" type="password" v-model="update.password_confirmation"></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formUpdate')">提交</Button>
        </div>
    </i-drawer>
</template>

<script>
    import contentDrawer from '../../../mixins/content-drawer'
    import IDrawer from "../../../components/content/drawer";

    export default {
        name: "create",
        components: {IDrawer},
        mixins: [contentDrawer],
        mounted() {
            this.$http(`authorities/user/${this.props.id}/edit`).then((res) => {
                this.update = res.data
                this.roles.data = res.roles;
                this.loading = false
            });
        },
        data() {
            return {
                loading: true,
                update: {
                    sex: 'women',
                    status: 'on'
                },
                departments: {
                    data: []
                },
                roles: {
                    data: []
                },
                ruleValidate: {
                    name: [
                        {required: true, message: '用户姓名必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 20, message: '用户姓名字符长度是2-20个字符', trigger: 'blur'}
                    ],
                    email: [
                        {required: true, message: '用户邮箱不能为空', trigger: 'blur'},
                        {type: 'email', message: '用户邮箱格式不正确', trigger: 'blur'},
                    ],
                    phone: [
                        {required: true, message: '手机号码必须填写', trigger: 'blur'},
                        {pattern: /^1[34578]\d{9}$/, message: '手机号码格式不正确', trigger: 'blur'}
                    ],
                    role_id: [
                        {required: true, type: 'number', message: '所属部门不能为空', trigger: 'change'},
                    ],
                    password: [
                        {type: 'string', min: 6, max: 20, message: '用户密码字符长度是6-20个字符', trigger: 'blur'}
                    ],
                    status: [
                        {required: true, type: 'enum', enum: ['off', 'on'], message: '用户状态不能为空'}
                    ],
                    sex: [
                        {required: true, type: 'enum', enum: ['women', 'man'], message: '性别状态不能为空'}
                    ],
                    password_confirmation: [
                        {
                            trigger: 'blur',
                            validator: (rule, value, callback) => {
                                if (value === this.update.password) {
                                    return callback();
                                } else {
                                    return callback('二次输入密码不正确')
                                }
                            }
                        }
                    ]
                }
            }
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.$http.put(`authorities/user/${this.props.id}`, this.update).then(() => {
                        this.loading = false;
                        this.closeDrawer(false)
                    });
                }).catch();
            }
        }
    }
</script>

<style scoped>
</style>