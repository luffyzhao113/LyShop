<template>
    <i-drawer title="部门添加" :width="720" :loading="loading">
        <Steps :current="current">
            <Step title="分配菜单"></Step>
            <Step title="分配权限"></Step>
        </Steps>
        <Form :model="create" :label-width="100" :rules="ruleValidate" ref="formCreate">
            <div v-show="current === 0">
                <FormItem label="部门名称" prop="name">
                    <Input v-model="create.name"></Input>
                </FormItem>
                <FormItem label="部门描述" prop="description">
                    <Input v-model="create.description" type="textarea" :rows="6"></Input>
                </FormItem>
                <FormItem label="分配菜单">
                    <div class="menu-box">
                        <div class="box-body">
                            <Tree :data="menus.data" show-checkbox multiple></Tree>
                        </div>
                    </div>
                </FormItem>
            </div>
            <div v-show="current === 1">
                <FormItem label="分配权限">
                    <Transfer
                            :titles="['可分配权限', '已有权限']"
                            :list-style="{width: '250px',height: '500px'}"
                            :data="authorities.data"
                            :target-keys="create.authorities"
                            @on-change="handleChange"></Transfer>
                </FormItem>
            </div>
        </Form>
        <div slot="footer">
            <Button type="primary" v-if="current === 1" @click="next">
                <Icon type="ios-arrow-back"></Icon>
                上一步
            </Button>
            <Button type="primary" v-if="current === 1" icon="ios-add" @click="submit('formCreate')">提交</Button>
            <Button type="primary" v-if="current === 0" @click="next">下一步
                <Icon type="ios-arrow-forward"></Icon>
            </Button>
        </div>
    </i-drawer>
</template>

<script>
    import contentDrawer from '../../../mixins/content-drawer'
    import IDrawer from "../../../components/content/drawer";

    export default {
        name: "create",
        components: {IDrawer},
        mixins: [contentDrawer],
        mounted() {
            this.$http.get(`authorities/role/create`).then((res) => {
                this.menus.data = this.setTreeData(res)
            }).finally(() => {
                this.loading = false
            });
        },
        data() {
            return {
                current: 0,
                loading: true,
                create: {
                    authorities: [],
                    menus: []
                },
                authorities: {
                    data: []
                },
                menus: {
                    data: []
                },
                ruleValidate: {
                    name: [
                        {required: true, message: '部门名称不能为空', trigger: 'blur'},
                        {type: 'string', min: 2, max: 20, message: '用户名称字符长度是2-20个字符', trigger: 'blur'}
                    ],
                    description: [
                        {type: 'string', max: 255, message: '部门描述最长255个字符', trigger: 'blur'}
                    ]
                },
                checked: false
            }
        },
        computed: {
            checkedMenus() {
                return this.toChecked(JSON.parse(JSON.stringify(this.menus.data)))
            }
        },
        methods: {
            handleChange(newTargetKeys) {
                this.create.authorities = newTargetKeys
            },
            submit(name) {

                this.validate('formCreate').then(() => {
                    this.loading = true
                    this.$http.post(`authorities/role`, this.create).then(() => {
                        this.closeDrawer(false)
                    }).finally(() => {
                        this.loading = false
                    });
                });
            },
            getAuthorities(){
                this.$http.get(`authorities/menu/authority`, {
                    params: {
                        ids: this.checkedMenus
                    }
                }).then((res) => {
                    this.authorities.data = this.toTransfer(res)
                });
            },
            next() {
                if (this.current === 0) {
                    this.validate('formCreate').then(() => {
                        if (this.checked === true) {
                            this.getAuthorities();
                        }
                        this.current = ++this.current
                    }).catch();
                } else {
                    this.current = --this.current;
                }
            },
            setTreeData(source) {
                let cloneData = JSON.parse(JSON.stringify(source))
                let tree = cloneData.filter(father => {
                    let branchArr = cloneData.filter(child => {
                        return father['id'] == child['parent_id']
                    });
                    if (branchArr.length > 0) {
                        father['children'] = branchArr
                    }
                    return father['parent_id'] == 0
                })
                return tree.map((item) => {
                    return Object.assign(item, {expand: true});
                })
            },
            toChecked(data) {
                let arr = [];
                data.forEach((item) => {
                    if (item.indeterminate === true || item.checked === true) {
                        arr.push(item.id)
                        if (item.children && item.children.length > 0) {
                            arr = arr.concat(this.toChecked(item.children));
                        }
                    }
                });
                return arr
            },
            toTransfer(data) {
                let lists = [];
                data.forEach((item) => {
                    item.authorities.forEach((val) => {
                        if (lists.findIndex((v) => v.key === val.id) === -1) {
                            lists.push({
                                key: val.id,
                                label: `${val.name}`
                            })
                        }
                    })
                })
                return lists
            }
        },
        watch: {
            checkedMenus(val) {
                this.create.menus = val
                this.checked = true
            }
        }
    }
</script>

<style lang="less">
    .ivu-steps {
        margin-bottom: 15px;
    }

    .menu-box {
        border: 1px solid #dcdee2;
        border-radius: 5px;

        .box-body {
            height: 500px;
            margin: 10px;
            overflow: auto;

            .ivu-tree ul li {
                margin: 0;
            }
        }
    }

</style>