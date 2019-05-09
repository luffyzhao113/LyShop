<template>
    <i-drawer title="部门添加" :width="720" :loading="loading">
        <Steps :current="current">
            <Step title="分配菜单"></Step>
            <Step title="分配权限"></Step>
        </Steps>
        <Form :model="data" :label-width="100" :rules="ruleValidate" ref="formUpdate">
            <div v-show="current === 0">
                <FormItem label="部门名称" prop="name">
                    <Input v-model="data.name"></Input>
                </FormItem>
                <FormItem label="部门描述" prop="description">
                    <Input v-model="data.description" type="textarea" :rows="6"></Input>
                </FormItem>
                <FormItem label="分配菜单">
                    <div class="menu-box">
                        <div class="box-body">
                            <l-tree :data="menus.data" v-model="data.menus" :contain-parent="true"></l-tree>
                        </div>
                    </div>
                </FormItem>
            </div>
            <div v-show="current === 1">
                <FormItem label="分配权限">
                    <Transfer
                            :titles="['可分配权限', '已有权限']"
                            :list-style="{width: '250px',height: '500px'}"
                            :data="authorities.data"
                            :target-keys="data.authorities"
                            @on-change="handleChange"></Transfer>
                </FormItem>
            </div>
        </Form>
        <div slot="footer">
            <Button type="primary" v-if="current === 1" @click="next('formUpdate')">
                <Icon type="ios-arrow-back"></Icon>
                上一步
            </Button>
            <Button type="primary" v-if="current === 1" icon="ios-add" @click="submit('formUpdate')">提交</Button>
            <Button type="primary" v-if="current === 0" @click="next('formUpdate')">下一步
                <Icon type="ios-arrow-forward"></Icon>
            </Button>
        </div>
    </i-drawer>
</template>

<script>
    import contentDrawer from '../../../mixins/content-drawer'
    import IDrawer from "../../../components/content/drawer";
    import LTree from "../../../components/form/tree";
    import role from "./role";

    export default {
        name: "update",
        components: {LTree, IDrawer},
        mixins: [contentDrawer, role],
        mounted() {
            this.$http.get(`authorities/role/${this.props.id}/edit`).then((res) => {
                this.data = res.row
                this.menus.data = res.menus
            }).finally(() => {
                this.loading = false
            });
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true
                    this.$http.put(`authorities/role/${this.props.id}`, this.data).then(() => {
                        this.closeDrawer(false)
                    }).finally(() => {
                        this.loading = false
                    });
                }).catch();
            }
        }
    }
</script>

<style scoped lang="less">
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