<template>
    <i-drawer title="权限添加" :loading="loading" :width="720">
        <Form ref="formUpdate" :model="update" :label-width="100" :rules="ruleValidate">
            <FormItem label="权限名称" prop="name">
                <Input v-model="update.name"></Input>
            </FormItem>
            <FormItem label="请求URI" prop="uri">
                <Input v-model="update.uri"></Input>
            </FormItem>
            <FormItem label="请求描述" prop="description">
                <Input v-model="update.description" type="textarea" :rows="3"></Input>
            </FormItem>
            <FormItem label="分配菜单">
                <div class="menu-box">
                    <div class="box-body">
                        <Tree :data="menus.data" show-checkbox multiple></Tree>
                    </div>
                </div>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button type="primary" icon="ios-add" @click="submit('formUpdate')">提交</Button>
        </div>
    </i-drawer>
</template>

<script>
    import contentDrawer from '../../../mixins/content-drawer'
    import IDrawer from "../../../components/content/drawer";

    export default {
        name: "update",
        components: {IDrawer},
        mixins: [contentDrawer],
        mounted() {
            this.$http.get(`authorities/authority/${this.props.id}/edit`).then((res) => {
                this.update = res.data
                this.menus.data = res.menus
                let data = [];
                JSON.parse(JSON.stringify(this.menus.data)).forEach((item) => {
                    data.push({
                        id: item.id,
                        parent_id: item.parent_id,
                        title: item.title,
                        expand: true,
                        indeterminate: this.indeterminate(item),
                        checked: this.checked(item)
                    })
                });
                this.menus.data = this.setTreeData(data)
            }).finally(() => this.loading = false);
        },
        data() {
            return {
                loading: true,
                update: {},
                menus: {
                    data: []
                },
                ruleValidate: {
                    name: [
                        {required: true, message: '权限名称必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 20, message: '权限名称字符长度是2-20个字符', trigger: 'blur'}
                    ],
                    uri: [
                        {required: true, message: '权限URI必须填写', trigger: 'blur'},
                        {type: 'string', min: 2, max: 50, message: '权限URI字符长度是2-50个字符', trigger: 'blur'}
                    ]
                }
            }
        }, computed: {
            checkedMenus() {
                return this.toChecked(JSON.parse(JSON.stringify(this.menus.data)))
            }
        },
        methods: {
            submit(name) {
                this.validate(name).then(() => {
                    this.loading = true
                    this.$http.put(`authorities/authority/${this.props.id}`,
                        Object.assign({}, this.update, {menus: this.checkedMenus})
                    ).then(() => {
                        this.closeDrawer(false)
                    }).finally(() => {
                        this.loading = false
                    });
                });
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
            child(parent) {
                return this.menus.data.filter(val => val.parent_id == parent)
            },
            indeterminate(item) {
                let hasChild = this.child(item.id).length > 0
                if (!hasChild) {
                    return false
                }
                let has = typeof this.update.menus.find(val => val === item.id) !== 'undefined'
                if (has) {
                    return true
                }
                return false;
            },
            checked(item) {
                let hasChild = this.child(item.id).length > 0
                if (hasChild) {
                    return false
                }
                let has = typeof this.update.menus.find(val => val === item.id) !== 'undefined'
                if (has) {
                    return true
                }
                return false;
            },
            toChecked(data) {
                let arr = [];
                data.forEach((item) => {
                    if (item.indeterminate === true || item.checked === true) {
                        item.checked === true && arr.push(item.id);
                        if (item.children && item.children.length > 0) {
                            arr = arr.concat(this.toChecked(item.children));
                        }
                    }
                });
                return arr
            }
        }
    }
</script>

<style lang="less">
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