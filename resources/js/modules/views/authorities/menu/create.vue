<template>
    <i-drawer title="菜单添加" :width="720" :loading="loading">
        <Form ref="formCreate" :model="create" :label-width="100" :rules="ruleValidate">
            <FormItem label="上级菜单">
                <Input :value="props.name" disabled></Input>
            </FormItem>
            <FormItem label="菜单名称" prop="name">
                <Input v-model="create.name"></Input>
            </FormItem>
            <FormItem label="菜单url" prop="url">
                <Input v-model="create.url"></Input>
            </FormItem>
            <FormItem label="菜单描述" prop="description">
                <Input v-model="create.description" type="textarea" :rows="4"></Input>
            </FormItem>
            <FormItem label="排序" prop="sort">
                <Input v-model="create.sort" number></Input>
            </FormItem>
            <FormItem label="分配权限">
                <Transfer
                        :titles="['可分配权限', '已有权限']"
                        :list-style="{width: '250px',height: '500px'}"
                        :data="authorities.data"
                        :target-keys="create.authorities"
                        @on-change="handleChange"></Transfer>
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

    export default {
        name: "create",
        components: {IDrawer},
        mixins: [contentDrawer],
        data() {
            return {
                create: {
                    parent_id: this.props.id,
                    sort: 99,
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
                },
                loading: true
            }
        },
        mounted(){
            this.$http.get(`authorities/menu/create`).then((res) => {
                this.authorities.data = res
            }).finally(() => {
                this.loading = false
            });
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.$http.post(`authorities/menu`, this.create).then(() => {
                        this.closeDrawer(false)
                    });
                }).catch(() => {

                });
            },
            handleChange(newTargetKeys) {
                this.create.authorities = newTargetKeys
            }
        }
    }
</script>

<style scoped>

</style>