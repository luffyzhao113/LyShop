export default {
    data() {
        return {
            loading: true,
            data: {},
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
    },
    methods: {
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
            let has = typeof this.data.menus.find(val => val === item.id) !== 'undefined'
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
            let has = typeof this.data.menus.find(val => val === item.id) !== 'undefined'
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