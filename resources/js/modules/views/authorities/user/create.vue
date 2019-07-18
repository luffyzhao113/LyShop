<template>
    <i-drawer title="用户添加" :width="620" :loading="loading">
        <Form :model="data" :label-width="100" :rules="ruleValidate" ref="formCreate">
            <FormItem label="姓名" prop="name">
                <Input placeholder="请输入姓名" v-model="data.name"></Input>
            </FormItem>
            <FormItem label="邮箱" prop="email">
                <Input placeholder="请输入邮箱" v-model="data.email"></Input>
            </FormItem>

            <Row>
                <Col span="12">
                    <FormItem label="手机号码" prop="phone">
                        <Input placeholder="手机号码" v-model="data.phone"></Input>
                    </FormItem>
                </Col>
                <Col span="12">
                    <FormItem label="用户状态" prop="status">
                        <i-switch true-value="on" false-value="off" v-model="data.status" size="large">
                            <span slot="open">开启</span>
                            <span slot="close">关闭</span>
                        </i-switch>
                    </FormItem>
                </Col>
            </Row>
            <Row>
                <Col span="12">
                    <FormItem label="出生日期" prop="birthday">
                        <DatePicker placeholder="出生日期" format="yyyy-MM-dd" @on-change="(val) => data.birthday = val"></DatePicker>
                    </FormItem>
                </Col>
                <Col span="12">
                    <FormItem label="用户性别" prop="sex">
                        <i-switch true-value="man" false-value="women" v-model="data.sex" size="large">
                            <span slot="open">男</span>
                            <span slot="close">女</span>
                        </i-switch>
                    </FormItem>
                </Col>
            </Row>
            <Row>
                <Col span="12">
                    <FormItem label="入职时间" prop="entryday">
                        <DatePicker placeholder="入职时间" format="yyyy-MM-dd" @on-change="(val) => data.entryday = val"></DatePicker>
                    </FormItem>
                </Col>
                <Col span="12">
                    <FormItem label="所属部门" prop="role_id">
                        <Select v-model="data.role_id">
                            <Option v-for="(item) in roles.data" :key="item.id" :value="item.id">
                                {{item.name}}
                            </Option>
                        </Select>
                    </FormItem>
                </Col>
            </Row>

            <FormItem label="密码" prop="password">
                <Input placeholder="请输入密码" type="password" v-model="data.password"></Input>
            </FormItem>
            <FormItem label="确认密码" prop="password_confirmation">
                <Input placeholder="请输入确认密码" type="password" v-model="data.password_confirmation"></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formCreate')">提交</Button>
        </div>
    </i-drawer>
</template>

<script>
    import contentDrawer from '../../../mixins/content-drawer'
    import IDrawer from "../../../components/content/drawer";
    import User from './user'

    export default {
        name: "data",
        components: {IDrawer},
        mixins: [contentDrawer, User],
        mounted() {
            this.$http(`authorities/user/create`).then((res) => {
                this.roles.data = res;
                this.loading = false
            });
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.post(`authorities/user`, this.data).then(() => {
                        this.closeDrawer(false)
                    }).finally(() => {
                        this.loading = false;
                    });
                }).catch();
            }
        }
    }
</script>

<style scoped>
</style>