<template>
    <Row class="content-wrapper">
        <Col :xs="12" :md="8" :lg="4" class="index-card-list">
            <Card :padding="0" :dis-hover="true" :shadow="true">
                <div class="info-card-wrapper">
                    <div class="left-area" style="background: #2d8cf0;">
                        <Icon type="md-analytics" size="36" color="#fff" class="i"/>
                    </div>
                    <div class="right-area">
                        <div class="count-to-wrapper">0</div>
                        <div class="">今日订单</div>
                    </div>
                </div>
            </Card>
        </Col>

        <Col :xs="12" :md="8" :lg="4" class="index-card-list">
            <Card :padding="0" :dis-hover="true" :shadow="true">
                <div class="info-card-wrapper">
                    <div class="left-area" style="background: #19be6b;">
                        <Icon type="md-finger-print" size="36" color="#fff" class="i"/>
                    </div>
                    <div class="right-area">
                        <div class="count-to-wrapper">0</div>
                        <div class="">今日销售额</div>
                    </div>
                </div>
            </Card>
        </Col>

        <Col :xs="12" :md="8" :lg="4" class="index-card-list">
            <Card :padding="0" :dis-hover="true" :shadow="true">
                <div class="info-card-wrapper">
                    <div class="left-area" style="background: #ed4014;">
                        <Icon type="logo-euro" size="36" color="#fff" class="i"/>
                    </div>
                    <div class="right-area">
                        <div class="count-to-wrapper">0</div>
                        <div class="">今日取消单数</div>
                    </div>
                </div>
            </Card>
        </Col>

        <Col :xs="12" :md="8" :lg="4" class="index-card-list">
            <Card :padding="0" :dis-hover="true" :shadow="true">
                <div class="info-card-wrapper">
                    <div class="left-area" style="background: #ff9900;">
                        <Icon type="ios-flask" size="36" color="#fff" class="i"/>
                    </div>
                    <div class="right-area">
                        <div class="count-to-wrapper">0</div>
                        <div class="">未发货数量</div>
                    </div>
                </div>
            </Card>
        </Col>

        <Col :xs="12" :md="8" :lg="4" class="index-card-list">
            <Card :padding="0" :dis-hover="true" :shadow="true">
                <div class="info-card-wrapper">
                    <div class="left-area" style="background: #17233d;">
                        <Icon type="md-contact" size="36" color="#fff" class="i"/>
                    </div>
                    <div class="right-area">
                        <div class="count-to-wrapper">0</div>
                        <div class="">新增用户</div>
                    </div>
                </div>
            </Card>
        </Col>


        <Col :xs="12" :md="8" :lg="4" class="index-card-list">
            <Card :padding="0" :dis-hover="true" :shadow="true">
                <div class="info-card-wrapper">
                    <div class="left-area" style="background: #2db7f5;">
                        <Icon type="md-filing" size="36" color="#fff" class="i"/>
                    </div>
                    <div class="right-area">
                        <div class="count-to-wrapper">0</div>
                        <div class="">商品数量</div>
                    </div>
                </div>
            </Card>
        </Col>


    </Row>
</template>

<script>
    export default {
        name: "index"
    }
</script>

<style scoped lang="less">
.content-wrapper{
    padding: 18px;
    overflow: auto;
    .index-card-list{
        padding: 0 10px 10px 10px;
        .ivu-card{
            overflow: hidden;
            .info-card-wrapper{
                height: 120px;
                .left-area{
                    float: left;
                    height: 100%;
                    display: table;
                    text-align: center;
                    width: 36%;
                    .i{
                        display: table-cell;
                        vertical-align: middle;
                    }
                }
                .right-area{
                    float: left;
                    height: 100%;
                    text-align: center;
                    width: 64%;
                    padding: 7px 0;
                    .count-to-wrapper{
                        font-size: 55px;
                    }
                }
            }
        }
    }
}
</style>