<template>
    <i-content :spin-show="false">
        <Form ref="formCreate" :model="data" :label-width="80" :rules="ruleValidate">
            <Card class="shop-setting">
                <Tabs>
                    <TabPane label="基础配置" icon="md-trophy">
                        <FormItem label="商城名称">
                            <Input v-model="data.name" />
                        </FormItem>
                    </TabPane>
                    <TabPane label="订单配置" icon="md-aperture">

                    </TabPane>
                    <TabPane label="图片配置" icon="ios-images">

                    </TabPane>
                    <TabPane label="其他配置" icon="md-snow">

                    </TabPane>

                </Tabs>
                <div class="shop-setting-footer">
                    <Button>保存</Button>
                </div>
            </Card>
        </Form>
    </i-content>
</template>

<script>
    import IContent from "../../../components/content/index";
    import ISearch from "../../../components/content/search";
    import ITable from "../../../components/content/table";

    export default {
        name: "index",
        components: {ITable, ISearch, IContent},
        data(){
            return {
                data:{},
                ruleValidate:{}
            }
        }
    }
</script>

<style lang="less">
.shop-setting{
    height: 100%;
    .ivu-card-body{
        display: flex;
        flex-direction:column;
        height: 100%;
        .shop-setting-footer{
            flex-basis: 50px;
            border-top: 1px solid #e8eaec;
            line-height: 50px;
            text-align: right;
        }
        .ivu-tabs{
            flex-grow: 1;
        }
    }
}
</style>