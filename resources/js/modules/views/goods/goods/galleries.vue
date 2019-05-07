<template>
    <div class="galleries-images">
        <div class="box-image">
            <img :src="bigFirstImage"/>
        </div>
        <div class="list-image scrollbar">
            <div class="item" v-for="(item, index) in images" :key="index" @click="view(index)">
                <Poptip placement="right" transfer trigger="hover">
                    <img :src="item.file">
                    <div class="item-poptip" slot="content">
                        <Button size="small" @click="handleTop(index)" :disabled="index === 0">上移</Button>
                        <Button size="small" @click="handleBottom(index)" :disabled="index === images.length">下移</Button>
                        <Button size="small" @click="handleRemove(index)">删除</Button>
                    </div>
                </Poptip>
            </div>

            <div class="item" v-for="item in file.before">
                <Spin size="large" fix></Spin>
            </div>

            <Upload type="drag" class="item" :action="action" :show-upload-list="false" multiple :headers="file.headers"
                    :on-success="file_success" :before-upload="file_before" :on-error="file_error">
                <div class="drag">
                    <Icon type="ios-cloud-upload" size="52"></Icon>
                </div>
            </Upload>
        </div>
    </div>
</template>

<script>
    import Emitter from 'iview/src/mixins/emitter'

    export default {
        name: "lGalleries",
        mixins: [Emitter],
        props: {
            value: {
                type: Array,
                default: () => []
            },
            action: {
                type: String,
                required: true
            },
            defaultGallery: {
                type: String,
                default: ''
            }
        },
        computed: {
            bigFirstImage() {
                return this.images.length > 0 ? this.images[this.index].file : this.defaultGallery;
            }
        },
        data() {
            return {
                images: this.value,
                index: 0,
                file: {
                    headers: {
                        authorization: 'bearer ' + this.$store.state.auth.login,
                        Accept: 'application/json'
                    },
                    loading: false,
                    before: 0
                }
            }
        },
        methods: {
            view(index){
                this.index = index;
            },
            handleRemove(index) {
                this.images.splice(index, 1);
                if(this.index === this.images.length){
                    this.index--;
                }
            },
            handleTop(x) {
                let y = x - 1;
                if (y < 0) {
                    return false;
                }
                this.images.splice(x, 1, ...this.images.splice(y, 1, this.images[x]))
            },
            handleBottom(x) {
                let y = x + 1;
                if (this.images.length <= y) {
                    return false;
                }
                this.images.splice(y, 1, ...this.images.splice(x, 1, this.images[y]))
            },
            file_success(response, file, fileList) {
                this.file.before--;
                this.images.push({
                    file: response.url
                });
                this.$emit('input', this.images);
                this.file.loading = false
            },
            file_before(file, fileList) {
                this.file.before++;
                this.file.loading = true
            },
            file_error(error, {errors}) {
                this.file.before--;
                this.$Message.error(errors.file[0]);
                this.file.loading = false
            }
        }
    }
</script>

<style lang="less">
    .galleries-images {
        height: 350px;
        color: #ccc;
        display: flex;

        .box-image {
            flex: 1;
            height: 350px;
            border: 1px dashed #dcdee2;
            float: left;
            position: relative;

            img {
                max-width: 90%;
                max-height: 90%;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                border-radius: 5px;
            }
        }

        .list-image {
            flex-basis: 140px;
            border: 1px dashed #dcdee2;
            border-left: none;
            height: 350px;
            overflow-y: auto;
            border-bottom-right-radius: 5px;
            border-top-right-radius: 5px;
            box-sizing: border-box;
            padding: 10px 0;

            .item {
                height: 90px;
                width: 90px;
                margin-left: 15px;
                color: #ccc;
                border: 1px dashed #dcdee2;
                border-radius: 4px;
                position: relative;
                margin-bottom: 5px;
                cursor: pointer;

                .ivu-poptip, .ivu-poptip-rel {
                    width: 100%;
                    height: 100%;
                }

                img {
                    max-width: 100%;
                    max-height: 100%;
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                }

                &.ivu-upload {
                    padding: 0;
                    border: none;

                    .ivu-upload-drag {
                        width: 100%;
                        height: 100%;
                        position: relative;

                        .ivu-icon {
                            position: absolute;
                            left: 50%;
                            top: 50%;
                            transform: translate(-50%, -50%);
                            color: #3399ff;
                        }
                    }
                }
            }
        }
    }
</style>