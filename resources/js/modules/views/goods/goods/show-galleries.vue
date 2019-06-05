<template>
    <div class="galleries-images">
        <div class="box-image">
            <img :src="bigFirstImage" alt=""/>
        </div>

        <div class="list-image scrollbar">
            <div class="item" v-for="(item, index) in images" :key="index" @click="view(index)">
                <img :src="item.file" alt=""/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "show-galleries",
        props: {
            value: {
                type: Array,
                default: () => []
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
            }
        },
        methods: {
            view(index) {
                this.index = index;
            },
        },
        watch: {
            value(val, old) {
                if (val !== old)
                    this.images = val;
            }
        }
    }
</script>

<style lang="less" scoped>
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

                img {
                    max-width: 100%;
                    max-height: 100%;
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                }
            }
        }
    }
</style>