<template>
    <i-drawer title="添加快递公司" :width="720" :loading="loading">
        <Form ref="formUpdate" :model="data" :label-width="100" :rules="ruleValidate">
            <FormItem label="快递公司名称" prop="name">
                <Input v-model="data.name"></Input>
            </FormItem>
            <Row>
                <Col span="12">
                    <FormItem label="查看物流轨迹" prop="view">
                        <RadioGroup v-model="data.view" type="button">
                            <Radio label="yes">支持</Radio>
                            <Radio label="no">不支持</Radio>
                        </RadioGroup>
                    </FormItem>
                </Col>

                <Col span="12">
                    <FormItem label="物流接口编号" prop="code">
                        <Input v-model="data.code"></Input>
                    </FormItem>
                </Col>
            </Row>
            <FormItem label="快递公司简介" prop="description">
                <Input v-model="data.description" type="textarea" :rows="6"></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formUpdate')">提交</Button>
        </div>
    </i-drawer>
</template>

<script>
    import contentDrawer from '../../../../mixins/content-drawer'
    import IDrawer from "../../../../components/content/drawer";
    import company from "./company";

    export default {
        name: "update",
        mixins: [contentDrawer, company],
        components: {IDrawer},
        mounted(){
            this.$http.get(`setting/express/company/${this.props.id}/edit`).then((res) => {
                this.data = res
            }).finally(() => {
                this.loading = false
            })
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true
                    this.$http.put(`setting/express/company/${this.props.id}`, this.data).then((res) => {
                        this.closeDrawer(false)
                    }).finally(() => {
                        this.loading = false
                    });
                })
            }
        }
    }
</script>

<style scoped>

</style>