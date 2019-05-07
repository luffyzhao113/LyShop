<template>
    <i-drawer title="权限添加" :loading="loading" :width="720">
        <Form ref="formUpdate" :model="update" :label-width="100" :rules="ruleValidate">
            <FormItem label="权限名称" prop="name">
                <Input v-model="update.name"></Input>
            </FormItem>
            <FormItem label="请求URI" prop="uri">
                <Input v-model="update.uri"></Input>
            </FormItem>
            <FormItem label="请求描述" prop="description">
                <Input v-model="update.description" type="textarea" :rows="3"></Input>
            </FormItem>
            <FormItem label="分配菜单">
                <div class="menu-box">
                    <div class="box-body">
                        <l-tree v-model="update.menus" :data="menus.data"></l-tree>
                    </div>
                </div>
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
    import LTree from "../../../components/form/tree";


    export default {
        name: "update",
        components: {LTree, IDrawer},
        mixins: [contentDrawer],
        mounted() {
            this.$http.get(`authorities/authority/${this.props.id}/edit`).then((res) => {
                this.update = res.row;
                this.menus.data = res.menus;
            }).finally(() => this.loading = false);
        },
        data() {
            return {
                loading: true,
                update: {},
                menus: {
                    data: []
                },
                ruleValidate: {
                    name: [
                        {required: true, message: '权限名称必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 20, message: '权限名称字符长度是2-20个字符', trigger: 'blur'}
                    ],
                    uri: [
                        {required: true, message: '权限URI必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 50, message: '权限URI字符长度是2-50个字符', trigger: 'blur'}
                    ]
                }
            }
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true
                    this.$http.put(`authorities/authority/${this.props.id}`,
                        Object.assign({}, this.update)
                    ).then(() => {
                        this.closeDrawer(false)
                    }).finally(() => {
                        this.loading = false
                    });
                });
            }
        }
    }
</script>

<style lang="less">
    .menu-box {
        border: 1px solid #dcdee2;
        border-radius: 5px;

        .box-body {
            height: 500px;
            margin: 10px;
            overflow: auto;

            .ivu-tree ul li {
                margin: 0;
            }
        }
    }
</style>