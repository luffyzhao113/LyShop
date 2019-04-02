<template>
    <i-drawer title="菜单修改" :width="720" :loading="loading">
        <Form ref="formUpdate" :model="update" :label-width="100" :rules="ruleValidate">
            <FormItem label="上级菜单">
                <Input v-model="update.parent.name" disabled></Input>
            </FormItem>
            <FormItem label="菜单名称" prop="name">
                <Input v-model="update.name"></Input>
            </FormItem>
            <FormItem label="菜单url" prop="url">
                <Input v-model="update.url"></Input>
            </FormItem>
            <FormItem label="菜单描述" prop="description">
                <Input v-model="update.description" type="textarea"></Input>
            </FormItem>
            <FormItem label="排序" prop="sort">
                <Input v-model="update.sort" number></Input>
            </FormItem>
            <FormItem label="分配权限">
                <Transfer
                        :titles="['可分配权限', '已有权限']"
                        :list-style="{width: '250px',height: '500px'}"
                        :data="authorities.data"
                        :target-keys="update.authorities"
                        @on-change="handleChange"></Transfer>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formUpdate')">提交</Button>
        </div>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../components/content/drawer";
    import contentDrawer from '../../../mixins/content-drawer'

    export default {
        name: "update",
        mixins: [contentDrawer],
        components: {IDrawer},
        mounted(){
            this.$http.get(`authorities/menu/${this.props.id}/edit`).then((res) => {
                res.data.parent = res.data.parent || {name: '顶级菜单'};
                this.update = res.data
                this.authorities.data = res.authorities
            }).finally(() => this.loading = false);
        },
        data(){
            return {
                loading: true,
                update: {
                    parent: {},
                    authorities: []
                },
                authorities: {
                    data: []
                },
                ruleValidate: {
                    name: [
                        {required: true, message: '菜单名称必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 20, message: '菜单名称字符长度是2-20个字符', trigger: 'blur'}
                    ],
                    url: [
                        {required: true, message: '菜单url必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 20, message: '菜单url字符长度是2-20个字符', trigger: 'blur'},
                    ],
                    sort: [
                        {required: true, type: 'number', message: '排序必须填写', trigger: 'blur'},
                        {type: 'number', min: 0, max: 99, message: '排序数值在0-99之间', trigger: 'blur'},
                    ]
                }
            }
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.$http.put(`authorities/menu/${this.props.id}`, this.update).then(() => {
                        this.closeDrawer(false)
                    });
                }).catch(() => {

                });
            },
            handleChange(newTargetKeys) {
                this.update.authorities = newTargetKeys
            }
        }
    }
</script>

<style scoped>

</style>