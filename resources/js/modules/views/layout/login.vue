<template>
    <div class="login">
        <div class="box">
            <div class="login-image">
                <img src="/vendor/images/login_image.jpg" />
            </div>
            <div class="login-box">
                <div class="login-logo">
                    <img src="/vendor/images/login_logo2.png" />
                </div>
                <div class="login-form">
                    <Form :label-width="0" :model="login" :rules="ruleValidate" ref="login">
                        <FormItem prop="email">
                            <Input prefix="ios-mail" v-model="login.email" placeholder="请输入登录邮箱" />
                        </FormItem>
                        <FormItem prop="password">
                            <Input prefix="md-lock" type="password" v-model="login.password" placeholder="请输入密码" />
                        </FormItem>
                        <FormItem>
                            <Button type="primary" long @click="submit('login')">登录</Button>
                        </FormItem>
                    </Form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import fromSubmit from '../../mixins/from-submit';

    export default {
        name: "login",
        mixins: [fromSubmit],
        data(){
            return {
                login: {},
                ruleValidate: {
                    email: [
                        {required: true, message: '用户邮箱不能为空', trigger: 'blur'},
                        {type: 'email', message: '用户邮箱格式不正确', trigger: 'blur'},
                    ],
                    password: [
                        {required: true, message: '用户密码不能为空', trigger: 'blur'},
                        {type: 'string', min: 6, max: 20, message: '用户密码字符长度是6-20个字符', trigger: 'blur'}
                    ]
                }
            }
        },
        methods: {
            submit(name){
                this.validate(name).then(() => {
                    this.$http.post('login', this.login).then((res) => {
                        this.$store.dispatch('auth/afterLogin', res);
                    });
                });
            }
        }
    }
</script>

<style scoped lang="less">
.login{
    height: 100vh;
    background-image: url("/vendor/images/login_bg.jpg");
    width: 100vw;
    overflow: hidden;
    position: relative;

    .box{
        width: 900px;
        height: 500px;
        border-radius: 10px;
        box-shadow: 0 1px 6px rgba(0,0,0,.3);
        border-color: #eee;
        background: #fff;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -250px;
        margin-left: -450px;
        display: flex;
        flex-direction: row;
        overflow: hidden;

        .login-image, .login-box{
            height: 500px;
            flex: 1;
        }

        .login-box{
            border-left: 1px #e8eaec solid;

            .login-logo{
                text-align: center;
                margin-top: 50px;
            }

            .login-form{
                height: 355px;
                margin-left: 55px;
                margin-right: 55px;
                border-top: 1px solid #e8eaec;
                padding-top: 35px;
                padding-left: 15px;
                padding-right: 15px;
            }
        }

    }
}
</style>