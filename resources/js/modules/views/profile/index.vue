<template>
    <Row class="content-wrapper">
        <Col :md="10" :lg="8" :xl="6" class="profile-card-list">
            <Card :padding="0" :dis-hover="true" :shadow="true" class="profile-detail-card">
                <div class="profile-detail">

                    <div class="profile-info">
                        <div class="profile-info-list">
                            <p>姓名: {{profile.name}}</p>
                            <div class="profile-role">
                                <Tag color="warning">{{profile.role ? profile.role.name : ''}}</Tag>
                            </div>
                            <p>邮箱: {{profile.email}}</p>
                            <p>手机号码: {{profile.phone}}</p>
                            <p>性别:
                                <Icon type="md-male" v-if="profile.sex === 'man'" color="#2d8cf0"/>
                                <Icon type="md-female" v-if="profile.sex === 'women'" color="#ed4014"/>
                            </p>
                            <p>生日: {{profile.birthday}}</p>
                            <p>入职时间: {{profile.entryday}}</p>
                        </div>
                    </div>
                </div>
            </Card>
        </Col>
        <Col :md="14" :lg="16" :xl="18" class="profile-card-list">
            <Card :dis-hover="true" :shadow="true" class="profile-edit-card">
                <Form :model="profile" :label-width="100" :rules="ruleValidate" ref="formProfile">
                    <FormItem label="手机号码" prop="phone">
                        <Input placeholder="手机号码" v-model="profile.phone"></Input>
                    </FormItem>
                    <Row class="ivu-form-item-row">
                        <Col span="12">
                            <FormItem label="生日" prop="birthday" @on-form-change="(val) => this.profile.birthday = val">
                                <DatePicker placeholder="生日" format="yyyy-MM-dd"
                                            @on-change="(val) => this.profile.birthday = val"
                                            v-model="profile.birthday"></DatePicker>
                            </FormItem>
                        </Col>
                        <Col span="12">
                            <FormItem label="性别" prop="sex">
                                <i-switch true-value="man" false-value="women" v-model="profile.sex">
                                    <span slot="open">男</span>
                                    <span slot="close">女</span>
                                </i-switch>
                            </FormItem>
                        </Col>
                    </Row>
                    <FormItem>
                        <Alert show-icon type="error" class="form-alert">如果不需要修改密码，下面可以不填。</Alert>
                    </FormItem>
                    <FormItem label="用户密码" prop="password_original">
                        <Input placeholder="请输入用户密码" v-model="profile.password_original"></Input>
                    </FormItem>
                    <FormItem label="修改后的密码" prop="password">
                        <Input placeholder="请输入修改后密码" v-model="profile.password"></Input>
                    </FormItem>
                    <FormItem label="确认修改后的密码" prop="password_confirmation">
                        <Input placeholder="请输入确认密码" v-model="profile.password_confirmation"></Input>
                    </FormItem>
                    <FormItem>
                        <Button type="primary" @click="submit('formProfile')">保存</Button>
                    </FormItem>
                </Form>
            </Card>
        </Col>
        <Spin size="large" fix v-if="loading"></Spin>
    </Row>
</template>

<script>
    import FromSubmit from '../../mixins/from-submit'

    export default {
        name: "index",
        mixins: [FromSubmit],
        data() {
            return {
                profile: {},
                loading: true,
                ruleValidate: {
                    phone: [
                        {required: true, message: '手机号码必须填写', trigger: 'blur'},
                        {pattern: /^1[34578]\d{9}$/, message: '手机号码格式不正确', trigger: 'blur'}
                    ],
                    password_original: [
                        {required: true, message: '用户密码不能为空', trigger: 'blur'},
                        {type: 'string', min: 6, max: 20, message: '用户密码字符长度是6-20个字符', trigger: 'blur'}
                    ],
                    password: [
                        {
                            validator: (rule, value, callback) => {
                                if (value === undefined || value === '') {
                                    return callback();
                                } else if (value.length < 6 || value.length > 20) {
                                    return callback('用户密码字符长度是6-20个字符');
                                } else if (value === this.profile.password_original) {
                                    return callback('修改后的密码不能和原始密码一样');
                                }
                            }, message: '用户密码不能为空', trigger: 'blur'
                        }
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
                                if (value === this.profile.password) {
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
        mounted() {
            this.$http.get('profile').then(res => {
                this.profile = res;
            }).finally(() => {
                this.loading = false
            })
        },
        methods: {
            submit(name){
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.put(`profile`, this.profile).then((res) => {

                    }).finally(() => {
                        this.loading = false
                    })
                }).catch(() => {

                })
            }
        }
    }
</script>

<style scoped lang="less">
    .content-wrapper {
        padding: 18px;
        overflow: auto;

        .profile-card-list {
            padding: 0 10px;

            .profile-edit-card {
                .form-alert {
                    margin-bottom: 0px;
                }
                .ivu-form-item-row{
                    margin-bottom: 24px;
                }
                .ivu-form-item:last-child{
                    margin-bottom: 0px;
                }
            }

            .profile-detail-card {
                margin-bottom: 10px;

                .profile-detail {
                    position: relative;
                    padding: 16px;

                    .profile-avatar {
                        height: 165px;
                        position: relative;

                        .profile-avatar-img, .profile-avatar-upload {
                            height: 150px;
                            width: 150px;
                            border-radius: 50%;
                            position: absolute;
                            left: 50%;
                            margin-left: -75px;
                            top: 0;
                            cursor: pointer;
                        }

                        .profile-avatar-upload {
                            z-index: 2;
                        }
                    }

                    .profile-info {
                        text-align: center;

                        .profile-info-list {
                            line-height: 28px;
                        }
                    }
                }
            }
        }
    }

</style>