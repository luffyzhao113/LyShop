<template>
    <i-drawer title="添加焦点图位置" :loading="loading">
        <Form ref="formCreate" :model="create" :label-width="120" :rules="ruleValidate">
            <FormItem label="位置名称" prop="name">
                <Input v-model="create.name"></Input>
            </FormItem>
            <FormItem label="位置说明" prop="description">
                <Input v-model="create.description" type="textarea" :rows="6"></Input>
            </FormItem>
        </Form>

        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formCreate')">提交</Button>
        </div>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../../components/content/drawer";
    import contentDrawer from '../../../../mixins/content-drawer'

    export default {
        name: "create",
        mixins: [contentDrawer],
        components: {IDrawer},
        data(){
            return {
                loading: false,
                create: {},
                ruleValidate: {
                    name: [
                        {required: true, message: '位置名称必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 50, message: '焦点图位置名称字符长度是2-50个字符', trigger: 'blur'}
                    ],
                    description: [
                        {max: 255, message: '位置说明最多支持255个字符', trigger: 'blur'}
                    ]
                }
            }
        },
        methods: {
            submit(name){
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.post(`setting/focus/position`, this.create).then(() => {
                        this.closeDrawer(false);
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