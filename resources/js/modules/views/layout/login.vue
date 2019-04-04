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
                    <Form :label-width="0">
                        <FormItem>
                            <Input prefix="ios-mail" placeholder="Enter name" />
                        </FormItem>
                        <FormItem>
                            <Input prefix="md-lock" placeholder="Enter name" />
                        </FormItem>
                    </Form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "login",
        methods: {
            t(){
                this.$store.dispatch('auth/afterLogin', 'xxx');
                this.$router.push({name: 'home'})
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