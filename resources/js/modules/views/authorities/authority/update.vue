<template>
    <i-drawer title="权限添加" :loading="loading" :width="720">
        <Form ref="formUpdate" :model="data" :label-width="100" :rules="ruleValidate">
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
                        <Tree :data="menus.data" show-checkbox multiple></Tree>
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
    import Authority from './authority'

    export default {
        name: "update",
        components: {IDrawer},
        mixins: [contentDrawer, Authority],
        mounted() {
            this.$http.get(`authorities/authority/${this.props.id}/edit`).then((res) => {
                this.data = res.data
                this.menus.data = res.menus
                let data = [];
                JSON.parse(JSON.stringify(this.menus.data)).forEach((item) => {
                    data.push({
                        id: item.id,
                        parent_id: item.parent_id,
                        title: item.title,
                        expand: true,
                        indeterminate: this.indeterminate(item),
                        checked: this.checked(item)
                    })
                });
                this.menus.data = this.setTreeData(data)
            }).finally(() => this.loading = false);
        },
        computed: {
            checkedMenus() {
                return this.toChecked(JSON.parse(JSON.stringify(this.menus.data)))
            }
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.put(`authorities/authority/${this.props.id}`,
                        Object.assign({}, this.data, {menus: this.checkedMenus})
                    ).then(() => {
                        this.closeDrawer(false)
                    }).finally(() => {
                        this.loading = false;
                    });
                }).catch(() => {
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