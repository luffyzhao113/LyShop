<template>
    <Row class="content-wrapper">
        <Col :md="10" :lg="8" :xl="6" class="profile-card-list">
            <Card :padding="0" :dis-hover="true" :shadow="true" class="profile-detail-card">
                <div class="profile-detail">
                    <div class="profile-avatar">
                        <img src="/vendor/images/profile.jpeg" class="profile-avatar-img">
                        <Upload action="//jsonplaceholder.typicode.com/posts/" :show-upload-list="false">
                            <div class="profile-avatar-upload"></div>
                        </Upload>
                    </div>
                    <div class="profile-info">
                        <div class="profile-info-list">
                            <div class="profile-role">
                                <Tag color="blue">订单管理员</Tag>
                                <Tag color="pink">仓库管理员</Tag>
                            </div>
                            <p>姓名: 尼古拉丁 丶 赵四</p>
                            <p>邮箱: luffyzhao@vip.126.com</p>
                            <p>手机号码: 18521425114</p>
                            <p>性别:
                                <Icon type="md-male" color="#17233d"/>
                            </p>
                            <p>生日: 03-09</p>
                            <p>入职时间: 2018-02-03</p>
                        </div>
                    </div>
                </div>
            </Card>
        </Col>
        <Col :md="14" :lg="16" :xl="18" class="profile-card-list">
            <Card :dis-hover="true" :shadow="true" class="profile-edit-card">
                <Form :label-width="100">
                    <FormItem label="邮箱">
                        <Input placeholder="请输入邮箱"></Input>
                    </FormItem>
                    <FormItem label="手机号码">
                        <Input placeholder="手机号码"></Input>
                    </FormItem>
                    <Row>
                        <Col span="12">
                            <FormItem label="生日">
                                <DatePicker placeholder="生日"></DatePicker>
                            </FormItem>
                        </Col>
                        <Col span="12">
                            <FormItem label="性别">
                                <i-switch>
                                    <span slot="open">男</span>
                                    <span slot="close">女</span>
                                </i-switch>
                            </FormItem>
                        </Col>
                    </Row>
                    <FormItem>
                        <Alert show-icon type="error" style="margin-bottom: 0px;">如果不需要修改密码，下面可以不填。</Alert>
                    </FormItem>
                    <FormItem label="原密码">
                        <Input placeholder="请输入原密码"></Input>
                    </FormItem>
                    <FormItem label="修改后密码">
                        <Input placeholder="请输入修改后密码"></Input>
                    </FormItem>
                    <FormItem label="确认密码">
                        <Input placeholder="请输入确认密码"></Input>
                    </FormItem>
                    <FormItem>
                        <Button type="primary">保存</Button>
                    </FormItem>
                </Form>
            </Card>
        </Col>
    </Row>
</template>

<script>
    export default {
        name: "index"
    }
</script>

<style scoped lang="less">
    .content-wrapper {
        padding: 18px;
        overflow: auto;

        .profile-card-list {
            padding: 0 10px;

            .profile-edit-card {

            }

            .profile-detail-card {
                margin-bottom: 10px;

                .profile-detail {
                    position: relative;
                    padding: 10px;

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