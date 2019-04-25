<template>
    <i-drawer title="添加焦点图" :loading="loading" :width="720">
        <Form ref="formUpdate" :model="update" :label-width="80" :rules="ruleValidate">
            <FormItem label="标题" prop="name">
                <Input v-model="update.name"></Input>
            </FormItem>

            <Row>
                <Col span="8">
                    <FormItem label="位置" prop="position_id">
                        <Select v-model="update.position_id">
                            <Option v-for="(val, index) in positions.data" :key="index" :value="val.id">{{val.name}}
                            </option>
                        </Select>
                    </FormItem>
                </Col>
                <Col span="8">
                    <FormItem label="排序" prop="sort">
                        <Input number v-model="update.sort"></Input>
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

            <FormItem label="跳转链接" prop="url">
                <Input v-model="update.url"></Input>
            </FormItem>

            <FormItem label="图片" prop="file" :error="file.error">
                <Upload type="drag" action="/api/setting/focus/file-edit" :headers="file.headers"
                        :on-success="file_success" :show-upload-list="false" class="upload-file"
                        :before-upload="file_before" :on-error="file_error"
                >
                    <div class="drag-file">
                        <div class="drag" v-if="update.file === undefined">
                            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                            <p>点击或者拖拽文件到这里</p>
                        </div>
                        <div class="file" v-else>
                            <img :src="update.file" alt="">
                        </div>
                        <div class="loading" v-if="fileLoading">
                            <Spin size="large" fix></Spin>
                        </div>
                    </div>
                </Upload>
            </FormItem>

            <FormItem label="说明" prop="description">
                <Input v-model="update.description" type="textarea" :rows="6"></Input>
            </FormItem>
        </Form>

        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formUpdate')">提交</Button>
        </div>
    </i-drawer>
</template>

<script>
    import IDrawer from "../../../components/content/drawer";
    import contentDrawer from '../../../mixins/content-drawer'

    export default {
        name: "update",
        mixins: [contentDrawer],
        components: {IDrawer},
        data() {
            return {
                loading: true,
                fileLoading: false,
                update: {
                    file: undefined,
                    status: 'off'
                },
                positions: {data: []},
                file: {
                    headers: {
                        authorization: 'bearer ' + this.$store.state.auth.login,
                        Accept: 'application/json'
                    },
                    error: undefined
                },
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
            this.$http.get(`setting/focus/${this.props.id}/edit`).then((res) => {
                this.positions.data = res.positions;
                this.update = res.row;
            }).finally(() => {
                this.loading = false;
            });
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.put(`setting/focus/${this.props.id}`, this.update).then(() => {
                        this.closeDrawer(false);
                    }).finally(() => {
                        this.loading = false;
                    });
                })
            },
            file_success(response, file, fileList) {
                this.update.file = response.url;
                this.fileLoading = false
            },
            file_before() {
                this.fileLoading = true
            },
            file_error(error, {errors}) {
                this.file.error = errors.file[0];
                this.fileLoading = false
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