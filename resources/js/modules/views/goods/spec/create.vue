<template>
    <i-drawer :loading="loading">
        <Form ref="formCreate" :model="create" :label-width="100" :rules="ruleValidate">
            <FormItem label="名称" prop="name">
                <Input v-model="create.name"></Input>
            </FormItem>

            <FormItem label="类型" prop="type">
                <Select v-model="create.type">
                    <Option value="attr">属性</Option>
                    <Option value="spec">规格</Option>
                </Select>
            </FormItem>

            <FormItem label="值" prop="values">
                <form-tags placeholder="属性值" v-model="create.values"></form-tags>
            </FormItem>

            <FormItem label="描述" prop="description">
                <Input v-model="create.description" type="textarea" :rows="3"></Input>
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
    import FormTags from "../../../components/form/tags";

    export default {
        name: "create",
        mixins: [contentDrawer],
        components: {FormTags, IDrawer},
        data() {
            return {
                loading: false,
                create: {},
                ruleValidate: {
                    name: [
                        {required: true, message: '名称必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 20, message: '名称字符长度是2-20个字符', trigger: 'blur'}
                    ],
                    values: [
                        {required: true, type: 'array', message: '属性值必须填写', trigger: 'blur'}
                    ],
                    type: [
                        {required: true,  message: '类型必须填写', trigger: 'blur'}
                    ],
                    description: [
                        {max: 255, message: '属性描述字符长度最多255个字条', trigger: 'blur'}
                    ]
                }
            }
        },
        methods: {
            submit(name){
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.post(`goods/spec`, this.create).then(() => {
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