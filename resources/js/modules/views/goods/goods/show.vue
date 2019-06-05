<template>
    <i-drawer :loading="loading" title="查看商品">
        <Row :gutter="20">
            <Col :span="14">
                <show-galleries v-model="data.galleries"></show-galleries>
            </Col>
            <Col :span="10">
                <h3>{{data.name}}</h3>
                <CellGroup>
                    <Cell title="单价">
                        <span slot="extra">￥{{data.price}}</span>
                    </Cell>
                    <Cell title="库存">
                        <span slot="extra">{{data.stock}} {{data.detail.unit}}</span>
                    </Cell>
                    <Cell title="查看次数">
                        <span slot="extra">{{data.view}}</span>
                    </Cell>
                    <Cell title="销量">
                        <span slot="extra">{{data.sales}}</span>
                    </Cell>
                    <Cell title="商品类型">
                        <span slot="extra">
                            <span v-if="data.type === 'normal'">正常</span>
                            <span v-if="data.type === 'group'">团购</span>
                            <span v-if="data.type === 'seckill'">秒杀</span>
                        </span>
                    </Cell>
                    <Cell title="状态">
                        <span slot="extra">{{data.status === 'grounding' ? '上架' : '下架' }}</span>
                    </Cell>
                    <Cell title="商品分类">
                        <span slot="extra">
                            <span v-for="(item, key) in data.categories" :key="key">
                                {{item.name}}
                            </span>
                        </span>
                    </Cell>
                </CellGroup>
            </Col>

            <Col span="14" style="margin-top: 20px;" >
                <div v-if="data.specs && data.specs.length > 0" class="spec-box">
                    <Row class="spec-header" :gutter="10">
                        <Col v-for="(val, key) in data.specs[0].items" :key="key" span="4">{{val.name}}</Col>
                        <Col span="6">价格</Col>
                        <Col span="6">库存</Col>
                    </Row>
                    <Row class="spec-list" v-for="(item, index) in data.specs" :key="index" :gutter="10">
                        <Col v-for="(val, key) in item.items" :key="key + '-' + index" span="4">{{val.value}}</Col>
                        <Col span="6">{{item.price}}</Col>
                        <Col span="6">{{item.stock}}</Col>
                    </Row>
                </div>
            </Col>

            <Col span="10" style="margin-top: 20px;">
                <Tag v-for="(item, index) in data.attributes" :key="index">{{item.name}}:{{item.values | join}}</Tag>
            </Col>

            <Col span="24">
                <div v-html="data.detail.describe" class="describe"></div>
            </Col>
        </Row>
    </i-drawer>
</template>

<script>
    import contentDrawer from '../../../mixins/content-drawer'
    import IDrawer from "../../../components/content/drawer";
    import ShowGalleries from "./show-galleries";

    export default {
        name: "show",
        mixins: [contentDrawer],
        components: {ShowGalleries, IDrawer},
        data(){
            return {
                loading: true,
                data:{
                    galleries: [],
                    detail:{},
                    categories: [],
                },
            }
        },
        mounted() {
            this.$http.get(`goods/goods/${this.props.id}`).then((res) => {
                this.data = res.row;
            }).finally(() => {
                this.loading = false
            })
        },
        filters: {
            join(val) {
                if (Array.isArray(val)) {
                    return val.join();
                }
                return val;
            }
        }
    }
</script>

<style scoped lang="less">
    .spec-box {
        border-radius: 4px;
        border: 1px solid #dcdee2;
        text-align: center;
        padding-left: 5px;
        padding-right: 5px;

        .spec-header {
            border-bottom: 1px #dcdee2 solid;
            height: 30px;
            line-height: 30px;

            .item-required {
                display: inline-block;
                margin-right: 4px;
                line-height: 1;
                font-family: SimSun;
                font-size: 12px;
                color: #ed4014;
            }
        }
    }

    .describe{
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-top: 20px;
        padding: 15px;
    }
</style>