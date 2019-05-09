<template>
    <i-drawer title="添加焦点图" :loading="loading" :width="720">
        <Form ref="formUpdate" :model="data" :label-width="80" :rules="ruleValidate">
            <FormItem label="标题" prop="name">
                <Input v-model="data.name"></Input>
            </FormItem>

            <Row>
                <Col span="8">
                    <FormItem label="位置" prop="position_id">
                        <Select v-model="data.position_id">
                            <Option v-for="(val, index) in positions.data" :key="index" :value="val.id">{{val.name}}
                            </option>
                        </Select>
                    </FormItem>
                </Col>
                <Col span="8">
                    <FormItem label="排序" prop="sort">
                        <Input number v-model="data.sort"></Input>
                    </FormItem>
                </Col>

                <Col span="8">
                    <FormItem label="状态" prop="status">
                        <i-switch v-model="data.status" true-value="on" false-value="off">
                            <span slot="open">开</span>
                            <span slot="close">关</span>
                        </i-switch>
                    </FormItem>
                </Col>
            </Row>

            <FormItem label="跳转链接" prop="url">
                <Input v-model="data.url"></Input>
            </FormItem>

            <FormItem label="图片" prop="file" :error="file.error">
                <l-upload action="/api/setting/focus/file-edit" v-model="create.file" class="thumbnail"></l-upload>
            </FormItem>

            <FormItem label="说明" prop="description">
                <Input v-model="data.description" type="textarea" :rows="6"></Input>
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
    import LUpload from "../../../components/form/upload";
    import focus from './focus'

    export default {
        name: "update",
        mixins: [contentDrawer, focus],
        components: {LUpload, IDrawer},
        mounted() {
            this.$http.get(`setting/focus/${this.props.id}/edit`).then((res) => {
                this.positions.data = res.positions;
                this.data = res.row;
            }).finally(() => {
                this.loading = false;
            });
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true;
                    this.$http.put(`setting/focus/${this.props.id}`, this.data).then(() => {
                        this.closeDrawer(false);
                    }).finally(() => {
                        this.loading = false;
                    });
                })
            },
            file_success(response, file, fileList) {
                this.data.file = response.url;
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