<template>
    <i-drawer title="修改类目" :loading="loading">
        <Form ref="formUpdate" :model="update" :label-width="80" :rules="ruleValidate">
            <FormItem label="名称" prop="name">
                <Input v-model="update.name"></Input>
            </FormItem>
            <Row>
                <Col span="8">
                    <FormItem label="上级类目" prop="parent_id">
                        <Input :value="props.name" disabled></Input>
                    </FormItem>
                </Col>
                <Col span="8">
                    <FormItem label="排序" prop="sort">
                        <Input v-model="update.sort" number></Input>
                    </FormItem>
                </Col>

                <Col span="8">
                    <FormItem label="状态" prop="status">
                        <i-switch v-model="update.status" true-value="on" false-value="off">
                            <span slot="open">开</span>
                            <span slot="close">关</span>
                        </i-switch>
                    </FormItem>
                </Col>
            </Row>

            <Row class="search_filters-box" :gutter="10">
                <Col span="4" align="center">
                    <span class="item-required">*</span>搜索属性名
                </Col>
                <Col span="18" align="center">
                    <span class="item-required">*</span>搜索属性值
                </Col>
                <Col span="2" align="center">
                    操作
                </Col>
                <Col span="24">
                    <Row v-for="(item, index) in update.search_filters" :key="index" :gutter="10">
                        <Col span="4" align="center">
                            <FormItem :label-width="0" :rules="[{required: true, message: '属性名必须填写'}]" :prop="'search_filters.'+index+'.name'">
                                <Input v-model="item.name" size="small"></Input>
                            </FormItem>
                        </Col>
                        <Col span="18" align="left">
                            <FormItem :label-width="0" :rules="[{required: true, type:'array', message: '属性值必须填写'}]">
                                <Tag closable v-for="(val, key) in item.values" :key="key"
                                     @on-close="close(item.values, key)">{{val}}
                                </Tag>
                                <Button type="dashed" @click="add(index)" size="small">添加搜索属性值</Button>
                            </FormItem>
                        </Col>
                        <Col span="2" align="center">
                            <FormItem :label-width="0">
                                <Button @click="remove(update.search_filters, index)" size="small">删除</Button>
                            </FormItem>
                        </Col>
                    </Row>
                </Col>
                <Col offset="18" span="6">
                    <FormItem :label-width="0">
                        <Button long size="small" @click="addAreaItem(update.search_filters)" type="dashed">添加一行
                        </Button>
                    </FormItem>
                </Col>
            </Row>

            <FormItem label="模板说明" prop="description">
                <Input v-model="update.description" type="textarea" :rows="4"></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formUpdate')">提交</Button>
        </div>
        <Modal v-model="filter.show">
            <p slot="header" style="color:#f60;text-align:center">
                <Icon type="ios-information-circle"></Icon>
                <span>添加属性值</span>
            </p>
            <Input v-model="filter.value" @on-enter="handleChangeOk"></Input>
            <div slot="footer">
                <Button type="primary" size="large" long @click="handleChangeOk">添加</Button>
            </div>
        </Modal>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../components/content/drawer";
    import contentDrawer from '../../../mixins/content-drawer'
    import {oneOf} from 'iview/src/utils/assist';

    export default {
        name: "update",
        mixins: [contentDrawer],
        components: {IDrawer},
        data() {
            return {
                loading: true,
                update: {
                    parent_id: this.props.id,
                    status: 'off',
                    search_filters: [{
                        name: '',
                        values: []
                    }]
                },
                positions: {data: []},
                filter: {show: false, index: undefined, value: undefined},
                ruleValidate: {
                    name: [
                        {required: true, message: '名称必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 50, message: '名称字符长度是2-50个字符', trigger: 'blur'}
                    ],
                    parent_id: [
                        {required: true, message: '上级类目必须填写', trigger: 'change'},
                    ],
                    sort: [
                        {required: true, type: 'number', message: '排序必须选择', trigger: 'blur'}
                    ],
                    description: [
                        {max: 255, message: '位置说明最多支持255个字符', trigger: 'blur'}
                    ],
                    status: [
                        {required: true, message: '状态必须选择', trigger: 'change'}
                    ]
                }
            }
        },
        mounted(){
            this.$http.get(`goods/category/${this.props.id}/edit`).then((res) => {
                this.update = res.row;
            }).finally(()=>{
                this.loading = false
            })
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.put(`goods/category/${this.props.id}`, this.update).then(() => {
                        this.closeDrawer(false)
                    }).finally(() => {
                        this.loading = false
                    });
                })
            },
            handleChangeOk() {
                if (this.filter.value) {
                    if (!oneOf(this.filter.value, this.update.search_filters[this.filter.index].values)) {
                        this.update.search_filters[this.filter.index].values.push(
                            this.filter.value
                        );
                        this.filter.value = undefined;
                        this.filter.show = false;
                        return;
                    }
                }
                this.$Message.warning('属性值已存在或者属性值不能为空！');
            },
            add(index) {
                this.filter.index = index;
                this.filter.show = true;
            },
            close(values, index) {
                values.splice(index, 1);
            },
            addAreaItem(search_filters) {
                search_filters.push({
                    name: '',
                    values: []
                })
            },
            remove(search_filters, index) {
                search_filters.splice(index, 1);
            }
        }
    }
</script>

<style lang="less">
    .search_filters-box{
        .item-required{
            display: inline-block;
            margin-right: 4px;
            line-height: 1;
            font-family: SimSun;
            font-size: 12px;
            color: #ed4014;
        }
        .ivu-form-item{
            margin-bottom: 10px;
            .ivu-form-item-error-tip{
                padding-top: 0px;
            }
        }
    }
</style>