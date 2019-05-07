<template>
    <i-drawer title="权限添加" :width="720" :loading="loading">
        <Form ref="formCreate" :model="create" :label-width="100" :rules="ruleValidate">
            <FormItem label="权限名称" prop="name">
                <Input v-model="create.name"></Input>
            </FormItem>
            <FormItem label="请求URI" prop="uri">
                <Input v-model="create.uri"></Input>
            </FormItem>
            <FormItem label="请求描述" prop="description">
                <Input v-model="create.description" type="textarea" :rows="3"></Input>
            </FormItem>
            <FormItem label="分配菜单">
                <div class="menu-box">
                    <div class="box-body">
                        <l-tree v-model="create.menus" :data="menus.data"></l-tree>
                    </div>
                </div>
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
    import LTree from "../../../components/form/tree";

    export default {
        name: "create",
        components: {LTree, IDrawer},
        mixins: [contentDrawer],
        data() {
            return {
                loading: true,
                create: {},
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
        }, mounted() {
            this.$http.get(`authorities/authority/create`).then((res) => {
                this.menus.data = res
            }).finally(() => {
                this.loading = false
            })
        }, methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true
                    this.$http.post(`authorities/authority`,
                        Object.assign({}, this.create)
                    ).then(() => {
                        this.closeDrawer(false)
                    }).finally(() => {
                        this.loading = false
                    });
                }).catch(() => {
                });
            }
        }
    }
</script>

<style lang="less">
    .ivu-steps {
        margin-bottom: 15px;
    }

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