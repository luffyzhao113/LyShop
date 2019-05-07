<template>
    <i-drawer :loading="loading">
        <Form ref="formUpdate" :model="update" :label-width="100" :rules="ruleValidate">
            <FormItem label="名称" prop="name">
                <Input v-model="update.name"></Input>
            </FormItem>

            <FormItem label="值" prop="values">
                <form-tags placeholder="属性值" v-model="update.values"></form-tags>
            </FormItem>

            <FormItem label="描述" prop="description">
                <Input v-model="update.description" type="textarea" :rows="3"></Input>
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
    import FormTags from "../../../components/form/tags";

    export default {
        name: "update",
        mixins: [contentDrawer],
        components: {FormTags, IDrawer},
        data() {
            return {
                loading: true,
                update: {},
                ruleValidate: {
                    name: [
                        {required: true, message: '名称必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 20, message: '名称字符长度是2-20个字符', trigger: 'blur'}
                    ],
                    values: [
                        {required: true, type: 'array', message: '属性值必须填写', trigger: 'blur'}
                    ],
                    description: [
                        {max: 255, message: '属性描述字符长度最多255个字条', trigger: 'blur'}
                    ]
                }
            }
        },
        mounted(){
            this.$http.get(`goods/spec/${this.props.id}/edit`).then((res) => {
                this.update = res.row
            }).finally(() => {
                this.loading = false;
            });
        },
        methods: {
            submit(name){
                this.validate(name).then(() => {
                    this.loading = true
                    this.$http.put(`goods/spec/${this.props.id}`, this.update).then(() => {
                        this.closeDrawer(false)
                    }).finally(() => {
                        this.loading = false;
                    });
                })
            }
        }
    }
</script>

<style scoped>

</style>