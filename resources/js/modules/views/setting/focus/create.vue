<template>
    <i-drawer title="添加焦点图" :loading="loading" :width="720">
        <Form ref="formCreate" :model="create" :label-width="80" :rules="ruleValidate">
            <FormItem label="标题" prop="name">
                <Input v-model="create.name"></Input>
            </FormItem>

            <Row>
                <Col span="8">
                    <FormItem label="位置" prop="position_id">
                        <Select v-model="create.position_id">
                            <Option v-for="(val, index) in positions.data" :key="index" :value="val.id">{{val.name}}
                            </option>
                        </Select>
                    </FormItem>
                </Col>
                <Col span="8">
                    <FormItem label="排序" prop="sort">
                        <Input number v-model="create.sort"></Input>
                    </FormItem>
                </Col>

                <Col span="8">
                    <FormItem label="状态" prop="status">
                        <i-switch v-model="create.status" true-value="on" false-value="off">
                            <span slot="open">开</span>
                            <span slot="close">关</span>
                        </i-switch>
                    </FormItem>
                </Col>
            </Row>

            <FormItem label="跳转链接" prop="url">
                <Input v-model="create.url"></Input>
            </FormItem>

            <FormItem label="图片" prop="file">
                <l-upload action="/api/setting/focus/file" v-model="create.file" class="thumbnail"></l-upload>
            </FormItem>

            <FormItem label="说明" prop="description">
                <Input v-model="create.description" type="textarea" :rows="6"></Input>
            </FormItem>
        </Form>

        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formCreate')">提交</Button>
        </div>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../components/content/drawer";
    import contentDrawer from '../../../mixins/content-drawer'
    import LUpload from "../../../components/form/upload";

    export default {
        name: "create",
        mixins: [contentDrawer],
        components: {LUpload, IDrawer},
        data() {
            return {
                loading: true,
                create: {
                    file: undefined,
                    status: 'off'
                },
                positions: {data: []},
                ruleValidate: {
                    name: [
                        {required: true, message: '名称必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 50, message: '焦点图位置名称字符长度是2-50个字符', trigger: 'blur'}
                    ],
                    position_id: [
                        {required: true, type: 'number', message: '焦点图位置必须选择', trigger: 'change'}
                    ],
                    sort: [
                        {required: true, type: 'number', message: '焦点图排序必须选择', trigger: 'blur'}
                    ],
                    status: [
                        {required: true, message: '焦点图状态必须选择', trigger: 'change'}
                    ],
                    description: [
                        {max: 255, message: '位置说明最多支持255个字符', trigger: 'blur'}
                    ],
                    file: [
                        {max: 255, message: '图片必须上传', trigger: 'change', required: true}
                    ],
                    url: [
                        {required: true, message: '跳转链接必须填写', trigger: 'blur'}
                    ]
                }
            }
        },
        mounted() {
            this.$http.get(`setting/focus/create`).then((res) => {
                this.positions.data = res.positions;
            }).finally(() => {
                this.loading = false;
            });
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.post(`setting/focus`, this.create).then(() => {
                        this.closeDrawer(false);
                    }).finally(() => {
                        this.loading = false;
                    });
                })
            }
        }
    }
</script>

<style scoped lang="less">
    .upload-file {
        .drag-file {
            padding: 25px 0;
            position: relative;
            height: 134px;

            .drag {
                width: 100%;
                height: 100%;
            }

            .file {
                position: absolute;
                height: 100%;
                width: 100%;
                top: 0;
                left: 0;
                padding: 5px;

                img {
                    max-width: 100%;
                    max-height: 100%;
                }
            }

            .loading {
                position: absolute;
                height: 100%;
                width: 100%;
                top: 0;
                left: 0;
            }
        }
    }

</style>