<template>
    <div class="spec-button-box">
        <Form class="specs">
            <Row v-for="(item, index) in data.values.values" :key="index">
                <Col span="10">
                    <div class="ivu-form-item">
                        <div class="ivu-form-item-label" style="width: 50px">规格名</div>
                        <div class="ivu-form-item-content">
                            <AutoComplete size="small" clearable :data="originName" :value="item.name"
                                          @on-clear="handleSelect(null, index)" @on-change="handleSelect($event, index)"
                                          @on-blur="handleBlur($event, index)" style="width: 100px;"></AutoComplete>
                        </div>
                    </div>
                </Col>
                <Col span="14" style="text-align: right;">
                    <Button type="dashed" size="small" @click="handleDelete(index)">删除</Button>
                </Col>
                <Col span="24" v-if="Array.isArray(item.values)">
                    <div class="ivu-form-item">
                        <div class="ivu-form-item-label" style="width: 50px">规格值</div>
                        <div class="ivu-form-item-content">
                            <AutoComplete size="small" v-for="(val, key) in item.values" clearable :key="`${index}-${key}`"
                                          :value="val" :data="valuesFilter(index)"
                                          @on-blur="handleValuesBlur($event, index, key)"
                                          @on-clear="handleValuesSelect(null, index, key)"
                                          @on-change="handleValuesSelect($event, index, key)"
                                          style="width: 100px; margin-right: 10px;"></AutoComplete>

                            <Button type="dashed" @click="handleClick(index)" size="small">添加商品规格值</Button>
                        </div>
                    </div>
                </Col>
            </Row>
            <div class="add-spec">
                <Button type="dashed" size="small" @click="handleClickAdd">添加商品规格</Button>
            </div>
        </Form>

        <div v-if="Array.isArray(data.values.specs) && data.values.specs.length > 0" class="spec-box">
            <Row class="spec-header">
                <Col v-for="(header, index) in sepcHeaders" span="4" :key="index">
                    {{header}}
                </Col>
                <Col span="4">价格<span class="item-required">*</span></Col>
                <Col span="4">库存<span class="item-required">*</span></Col>
                <Col span="4">操作</Col>
            </Row>
            <Row class="spec-list" v-for="(item, index) in data.values.specs" :key="index" :gutter="10">
                <Col v-for="(val, key) in item.items" :key="key + '-' + index" span="4">&nbsp;{{val.value}}</Col>
                <Col span="4">
                    <FormItem :label-width="0">
                        <Input v-model="item.price" size="small" number></Input>
                    </FormItem>
                </Col>
                <Col span="4">
                    <FormItem :label-width="0">
                        <Input v-model="item.stock" size="small" number></Input>
                    </FormItem>
                </Col>
                <Col span="4">
                    <Button size="small" type="dashed">删除</Button>
                </Col>
            </Row>
        </div>
    </div>
</template>

<script>
    import {product} from "../../../../libs/util";

    export default {
        name: "specs",
        props: {
            value: {
                type: Object,
                required: true,
                default: {
                    values: [],
                    specs: []
                }
            }
        },
        data() {
            return {
                data: {
                    origin: [{name: '颜色', values: ['红色']}],
                    values: this.defaultValue(this.value)
                }
            }
        },
        computed: {
            originName() {
                const {origin, values} = this.data;
                return origin.filter((val) => {
                    let bool = true;
                    values.values.forEach((item) => {
                        if(item.name === val.name){
                            bool = false;
                        }
                    });
                    return bool;
                }).map((val) => {
                    return val.name;
                });
            },
            sepcHeaders(){
                const {values} = this.data.values;
                let headers = [];
                values.forEach((val) => {
                    headers.push(val.name)
                });
                return headers;
            }
        },
        methods: {
            defaultValue(item){
                return {
                    values: item.values || [],
                    specs: item.specs || []
                }
            },
            handleBlur(event, index) {
                this.handleSelect(event.target.value, index);
            },
            handleSelect(value, index) {
                let {values} = this.data.values;
                if (values[index].name === value) {
                    return;
                }
                let item = {
                    values: [''],
                    name: Boolean(value) ? value : ''
                };
                this.$set(this.data.values.values, index, item);
                this.changes();
            },
            handleValuesBlur(event, index, key) {
                if(!Boolean(event.target.value)){
                    return;
                }
                this.handleValuesSelect(event.target.value, index, key);
            },
            handleValuesSelect(value, index, key) {
                let item = JSON.parse(JSON.stringify(this.data.values.values[index]));
                if (item.values.filter(v => v === value).length > 0) {
                    return;
                }
                if(value === null){
                    this.$delete(item.values, key);
                }else{
                    this.$set(item.values, key, value);
                }
                this.$set(this.data.values.values, index, item);
                this.changes();
            },
            handleClick(index){
                let item = JSON.parse(JSON.stringify(this.data.values.values[index]));
                item.values.push('');
                this.$set(this.data.values.values, index, item);
                this.changes();
            },
            handleClickAdd(){
                this.data.values.values.push({
                    name: '',
                    values: ['']
                });
                this.changes();
            },
            handleDelete(index){
                this.$delete(this.data.values.values, index);
                this.changes();
            },
            changes(){
                let array = [];
                this.data.values.values.forEach((val) => {
                    array.push(val.values)
                })
                this.data.values.specs = JSON.parse(JSON.stringify(product(array)));
                this.$emit('input', this.data.values);
            },
            valuesFilter(index) {
                let values = this.data.origin.find((v) => v.name === this.value.values[index].name) || {values: []};
                return values.values.filter((v) => {
                    for (let i = 0; i < this.value.values[index].values.length; i++) {
                        if (v === this.value.values[index].values[i]) {
                            return false;
                        }
                    }
                    return true;
                });
            }
        }
    }
</script>

<style scoped lang="less">
    .add-spec {
        margin: 10px 0;
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