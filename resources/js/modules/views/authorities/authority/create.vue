<template>
    <i-drawer title="权限添加" :width="720" :loading="loading">
        <Form ref="formCreate" :model="data" :label-width="100" :rules="ruleValidate">
            <FormItem label="权限名称" prop="name">
                <Input v-model="data.name"></Input>
            </FormItem>
            <FormItem label="请求URI" prop="uri">
                <Input v-model="data.uri"></Input>
            </FormItem>
            <FormItem label="请求描述" prop="description">
                <Input v-model="data.description" type="textarea" :rows="3"></Input>
            </FormItem>
            <FormItem label="分配菜单">
                <div class="menu-box">
                    <div class="box-body">
                        <l-tree v-model="data.menus" :data="menus.data"></l-tree>
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
    import authority from "./authority";

    export default {
        name: "create",
        components: {LTree, IDrawer},
        mixins: [contentDrawer, authority],
        mounted() {
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
                        Object.assign({}, this.data)
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