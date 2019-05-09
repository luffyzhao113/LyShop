<template>
    <i-drawer title="修改焦点图位置" :loading="loading">
        <Form ref="formUpdate" :model="data" :label-width="120" :rules="ruleValidate">
            <FormItem label="位置名称" prop="name">
                <Input v-model="data.name"></Input>
            </FormItem>
            <FormItem label="位置说明" prop="description">
                <Input v-model="data.description" type="textarea" :rows="6"></Input>
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
    import position from './position'

    export default {
        name: "update",
        mixins: [contentDrawer, position],
        components: {IDrawer},
        mounted(){
            this.loading = true;
            this.$http.get(`setting/focus/position/${this.props.id}/edit`).then((res) => {
                this.data = res;
            }).finally(() => {
                this.loading = false;
            })
        },
        methods: {
            submit(name){
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.put(`setting/focus/position/${this.props.id}`, this.data).then(() => {
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