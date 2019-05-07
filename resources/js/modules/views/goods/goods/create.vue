<template>
    <i-drawer :loading="loading" title="添加商品" :width="920">
        <Form ref="formCreate" :model="create" :label-width="100" :rules="ruleValidate">
            <FormItem label="商品名称" prop="name">
                <Input v-model="create.name"></Input>
            </FormItem>
            <Row>
                <Col span="16">
                    <Row>
                        <Col span="12">
                            <FormItem label="商品价格" prop="price">
                                <Input v-model="create.price"></Input>
                            </FormItem>
                        </Col>
                        <Col span="12">
                            <FormItem label="商品库存" prop="stock">
                                <Input v-model="create.stock"></Input>
                            </FormItem>
                        </Col>
                    </Row>

                    <Row>
                        <Col span="12">
                            <FormItem label="商品重量" prop="weight">
                                <Input v-model="create.weight"></Input>
                            </FormItem>
                        </Col>
                        <Col span="12">
                            <FormItem label="商品单位" prop="details.unit">
                                <Select v-model="create.details.unit">
                                    <Option v-for="(item, key) in units.data" :key="key" :label="item"
                                            :value="item"></Option>
                                </Select>
                            </FormItem>
                        </Col>
                    </Row>

                    <Row>
                        <Col span="12">
                            <FormItem label="商品类型" prop="type">
                                <RadioGroup v-model="create.type">
                                    <Radio label="normal">正常</Radio>
                                    <Radio label="group">团购</Radio>
                                    <Radio label="seckill">秒杀</Radio>
                                </RadioGroup>
                            </FormItem>
                        </Col>
                        <Col span="12">
                            <FormItem label="商品状态" prop="status">
                                <RadioGroup v-model="create.status">
                                    <Radio label="grounding">上架</Radio>
                                    <Radio label="undercarriage">下架</Radio>
                                </RadioGroup>
                            </FormItem>
                        </Col>
                    </Row>

                    <FormItem label="商品分类" prop="categories">
                        <tag v-for="(item, key) in create.categories" :key="key">{{categoriesName(item)}}</tag>
                        <Button type="dashed" size="small" @click="categories.modal = true">
                            选择分类
                        </Button>
                    </FormItem>

                </Col>

                <Col push="2" span="6">
                    <l-upload :action="categories.url" v-model="create.file" class="thumbnail"></l-upload>
                </Col>

            </Row>

            <FormItem label="商品组图" prop="gallery">
                <l-galleries :action="categories.url" v-model="create.gallery"
                             :default-gallery="config.default_gallery"></l-galleries>
            </FormItem>

            <div class="ivu-form-item">
                <label class="ivu-form-item-label" style="width: 100px;">商品规格</label>
                <div class="ivu-form-item-content" style="margin-left: 100px;">
                    <Button size="small" @click="specs.modal = true" type="dashed">添加商品规格</Button>

                    <div v-if="create.specs && create.specs.length > 0" class="spec-box">
                        <Row class="spec-header">
                            <Col v-for="(header, index) in specs.headers" span="4" :key="index">
                                {{header}}
                            </Col>
                            <Col span="4">价格<span class="item-required">*</span></Col>
                            <Col span="4">库存<span class="item-required">*</span></Col>
                            <Col span="4">操作</Col>
                        </Row>
                        <Row class="spec-list" v-for="(item, index) in create.specs" :key="index" :gutter="10">
                            <Col v-for="(val, key) in item.items" :key="key + '-' + index" span="4">{{val.value}}</Col>
                            <Col span="4">
                                <FormItem :label-width="0" :prop="'specs.'+index+'.price'"
                                          :rules="[{required: true, type:'number', message: '价格必须填写', trigger: 'blur'}]">
                                    <Input v-model="item.price" size="small" number></Input>
                                </FormItem>
                            </Col>
                            <Col span="4">
                                <FormItem :label-width="0" :prop="'specs.'+index+'.stock'"
                                          :rules="[{required: true, type:'number', message: '库存必须填写', trigger: 'blur'}]">
                                    <Input v-model="item.stock" size="small" number></Input>
                                </FormItem>
                            </Col>
                            <Col span="4">
                                <Button size="small" type="dashed" @click="deleteSpec(index)">删除</Button>
                            </Col>
                        </Row>
                    </div>
                </div>
            </div>

            <FormItem label="商品属性">
                <Tag v-for="(item, index) in create.attributes" :key="index">{{item.name}}:{{item.values | join}}</Tag>
                <Button size="small" @click="attributes.modal = true" type="dashed">添加商品属性</Button>
            </FormItem>

            <FormItem label="商品描述">
                <ueditor v-model="create.details.describe"
                         :config="ueditor"></ueditor>
            </FormItem>

        </Form>

        <Modal v-model="categories.modal" title="选择商品类目">
            <p slot="header" style="color:#f60;text-align:center">
                <Icon type="ios-information-circle"></Icon>
                <span>商品类目</span>
            </p>
            <l-tree :data="categories.data" v-model="categories.wait"></l-tree>
            <div slot="footer">
                <Button type="primary" size="large" long @click="handleChangeCategory">选择</Button>
            </div>
        </Modal>


        <Modal v-model="specs.modal" title="选择商品规格">
            <p slot="header" style="color:#f60;text-align:center">
                <Icon type="ios-information-circle"></Icon>
                <span>商品规格</span>
            </p>
            <template v-for="(item, index) in specs.data">
                <div class="checkbox-item">
                    <Checkbox :indeterminate="specs.wait[item.name] && specs.wait[item.name].length > 0">{{item.name}}
                    </Checkbox>
                    <CheckboxGroup v-model="specs.wait[item.name]">
                        <Checkbox v-for="(val, key) in item.values" :key="key" :label="val">{{val}}</Checkbox>
                    </CheckboxGroup>
                </div>
            </template>
            <div slot="footer">
                <Button type="primary" size="large" long @click="handleChangeSpec">选择</Button>
            </div>
        </Modal>

        <Modal v-model="attributes.modal" title="选择商品属性">
            <p slot="header" style="color:#f60;text-align:center">
                <Icon type="ios-information-circle"></Icon>
                <span>商品属性</span>
            </p>
            <template v-for="(item, index) in attributes.data">
                <div class="checkbox-item">
                    <Checkbox :indeterminate="attributes.wait[item.name] && attributes.wait[item.name].length > 0">{{item.name}}
                    </Checkbox>
                    <CheckboxGroup v-model="attributes.wait[item.name]">
                        <Checkbox v-for="(val, key) in item.values" :key="key" :label="val">{{val}}</Checkbox>
                    </CheckboxGroup>
                </div>
            </template>
            <div slot="footer">
                <Button type="primary" size="large" long @click="handleChangeAttribute">选择</Button>
            </div>
        </Modal>
    </i-drawer>
</template>

<script>
    import contentDrawer from '../../../mixins/content-drawer'
    import IDrawer from "../../../components/content/drawer";
    import LUpload from "../../../components/form/upload";
    import LTree from "../../../components/form/tree";
    import Emitter from 'iview/src/mixins/emitter'
    import LGalleries from "./galleries";
    import Ueditor from "../../../components/form/ueditor";
    import {product} from "../../../../libs/util";


    export default {
        name: "create",
        mixins: [contentDrawer, Emitter],
        components: {Ueditor, LGalleries, LTree, LUpload, IDrawer},
        data() {
            return {
                loading: true,
                create: {
                    type: 'normal',
                    categories: [],
                    details: {},
                    gallery: [],
                    specs: [],
                    attributes: []
                },
                ruleValidate: {},
                categories: {
                    modal: false,
                    wait: [],
                    data: [],
                    url: '/api/setting/focus/file'
                },
                config: {},
                units: {
                    data: []
                },
                specs: {
                    modal: false,
                    data: [],
                    wait: {},
                    headers: []
                },
                attributes: {
                    modal: false,
                    wait: {},
                    data: []
                },
                ueditor: {
                    serverUrl: '/api/goods/goods/create/ueditor',
                    initialFrameHeight: 600
                }
            }
        },
        mounted() {
            this.$http.get(`goods/goods/create`).then((res) => {
                this.categories.data = res.categories
                this.units.data = res.units
                this.specs.data = res.specs
                this.attributes.data = res.attributes
                this.config = res.config
            }).finally(() => {
                this.loading = false
            })
        },
        methods: {
            handleChangeCategory() {
                this.create.categories = this.categories.wait;
                this.categories.modal = false;
                this.dispatch('FormItem', 'on-form-change', this.create.categories);
            },
            handleChangeSpec() {
                let array = [];
                this.specs.headers = [];
                for (let waitKey in this.specs.wait) {
                    let item = this.specs.wait[waitKey];
                    if (item.length === 0) {
                        continue;
                    }
                    let arr = [];
                    item.forEach(val => {
                        arr.push({
                            name: waitKey,
                            value: val
                        });
                    });
                    this.specs.headers.push(waitKey)
                    array.push(arr)
                }
                if (array.length > 3) {
                    this.$Message.error('商品规格最多只能选择3个！')
                } else {
                    this.create.specs = product(array);
                    this.specs.modal = false;
                }
            },
            handleChangeAttribute(){
                let array = [];
                for (let waitKey in this.attributes.wait) {
                    let item = this.attributes.wait[waitKey];
                    if (item.length === 0) {
                        continue;
                    }
                    array.push({
                        name: waitKey,
                        values: item
                    })
                }
                this.create.attributes = array;
                this.attributes.modal = false;
            },
            deleteSpec(index) {
                this.create.specs.splice(index, 1);
            },
            categoriesName(id) {
                return this.categories.data.find((v) => v.id === id)['title'];
            }
        },
        filters:{
            join(val){
                if(Array.isArray(val)){
                    return val.join();
                }
                return val;
            }
        }
    }
</script>

<style scoped lang="less">
    .thumbnail {
        width: 100%;
        height: 220px;
    }

    .checkbox-item {
        border-bottom: 1px solid #e9e9e9;
        padding: 6px;

        &:last-child {
            border-bottom-width: 0px;
        }

        .ivu-checkbox-group {
            margin-top: 10px;
            margin-left: 20px;
        }
    }

    .spec-box {
        border-radius: 4px;
        border: 1px solid #dcdee2;
        text-align: center;

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
</style>

<style lang="less">
    .spec-list {
        .ivu-form-item-error-tip {
            top: 50%;
            transform: translateY(-50%);
            left: 104%;
            z-index: 1;
            background-color: #fff;
            width: 100%;
            text-align: left;
        }
    }
</style>