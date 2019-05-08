<template>
    <i-drawer title="添加快递公司" :width="720" :loading="loading">
        <Form ref="formCreate" :model="data" :label-width="100" :rules="ruleValidate">
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
                    <FormItem prop="code">
                        <span slot="label">
                            物流编号
                            <Tooltip placement="top">
                                <span slot="content">快递公司标准国际编码.</span>
                                <Icon type="md-alert" size="16"/>
                            </Tooltip>
                        </span>
                        <Input v-model="data.code"></Input>
                    </FormItem>
                </Col>
            </Row>
            <FormItem label="快递公司简介" prop="description">
                <Input v-model="data.description" type="textarea" :rows="6"></Input>
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
    import company from "./company";

    export default {
        name: "create",
        mixins: [contentDrawer, company],
        components: {IDrawer},
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true
                    this.$http.post(`setting/express/company`, this.data).then((res) => {
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