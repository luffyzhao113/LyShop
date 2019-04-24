<template>
    <i-drawer title="修改焦点图位置" :loading="loading">
        <Form ref="formUpdate" :model="update" :label-width="120" :rules="ruleValidate">
            <FormItem label="位置名称" prop="name">
                <Input v-model="update.name"></Input>
            </FormItem>
            <FormItem label="位置说明" prop="description">
                <Input v-model="update.description" type="textarea" :rows="6"></Input>
            </FormItem>
        </Form>

        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formUpdate')">提交</Button>
        </div>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../../components/content/drawer";
    import contentDrawer from '../../../../mixins/content-drawer'

    export default {
        name: "update",
        mixins: [contentDrawer],
        components: {IDrawer},
        data(){
            return {
                loading: false,
                update: {},
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
        mounted(){
            this.loading = true;
            this.$http.get(`setting/focus/position/${this.props.id}/edit`).then((res) => {
                this.update = res;
            }).finally(() => {
                this.loading = false;
            })
        },
        methods: {
            submit(name){
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.put(`setting/focus/position/${this.props.id}`, this.update).then(() => {
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