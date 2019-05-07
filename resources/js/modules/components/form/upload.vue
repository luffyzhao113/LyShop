<template>
    <Upload type="drag" :action="action" :headers="file.headers"
            :on-success="file_success" :show-upload-list="false" class="upload-drag"
            :before-upload="file_before" :on-error="file_error"
    >
        <div class="drag-file">
            <div class="drag" v-if="value === ''">
                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
            </div>
            <div class="file" v-else>
                <img :src="value" alt="">
            </div>
            <div class="loading" v-if="file.loading">
                <Spin size="large" fix></Spin>
            </div>
        </div>
    </Upload>
</template>

<script>
    export default {
        name: "l-upload",
        props: {
            action: {
                type: String,
                required: true
            },
            value: {
                type: String,
                default: ''
            }
        },
        data() {
            return {
                file: {
                    headers: {
                        authorization: 'bearer ' + this.$store.state.auth.login,
                        Accept: 'application/json'
                    },
                    error: undefined,
                    loading: false
                },
            }
        },
        methods: {
            file_success(response, file, fileList) {
                this.$emit('input', response.url);
                this.file.loading = false
            },
            file_before() {
                this.file.loading = true
            },
            file_error(error, {errors}) {
                this.$Message.error(errors.file[0]);
                this.file.loading = false
            }
        }
    }
</script>

<style lang="less">
    .upload-drag {
        display: block;
        padding: 4px;
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: border .2s ease-in-out;

        .ivu-upload-drag {
            height: 100%;
        }

        .drag-file {
            padding: 25px 0;
            position: relative;
            height: 100%;

            .drag {
                width: 100%;
                height: 100%;
                position: relative;
                .ivu-icon {
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                }
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
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
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