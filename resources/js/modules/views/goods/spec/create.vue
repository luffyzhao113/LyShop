<template>
    <i-drawer :loading="loading">
        <Form ref="formCreate" :model="data" :label-width="100" :rules="ruleValidate">
            <FormItem label="名称" prop="name">
                <Input v-model="data.name"></Input>
            </FormItem>

            <FormItem label="类型" prop="type">
                <Select v-model="data.type">
                    <Option value="attr">属性</Option>
                    <Option value="spec">规格</Option>
                </Select>
            </FormItem>

            <FormItem label="值" prop="values">
                <form-tags placeholder="属性值" v-model="data.values"></form-tags>
            </FormItem>

            <FormItem label="描述" prop="description">
                <Input v-model="data.description" type="textarea" :rows="3"></Input>
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
    import spec from "./spec";

    export default {
        name: "create",
        mixins: [contentDrawer, spec],
        components: {FormTags, IDrawer},
        methods: {
            submit(name){
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.post(`goods/spec`, this.data).then(() => {
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