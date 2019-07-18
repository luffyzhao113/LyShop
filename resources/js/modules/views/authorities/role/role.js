export default {
    data(){
        return {
            current: 0,
            loading: true,
            data: {
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
                    {type: 'string', min: 2, max: 20, message: '权限名称字符长度是2-20个字符', trigger: 'blur'}
                ],
                description: [
                    {type: 'string', max: 255, message: '权限描述最长255个字符', trigger: 'blur'}
                ]
            }
        }
    },
    methods: {
        handleChange(newTargetKeys) {
            this.data.authorities = newTargetKeys
        },
        getAuthorities(){
            this.$http.get(`authorities/menu/authority`, {
                params: {
                    ids: this.data.menus
                }
            }).then((res) => {
                this.authorities.data = this.toTransfer(res)
            });
        },
        next(name) {
            if (this.current === 0) {
                this.validate(name).then(() => {
                    this.getAuthorities();
                    this.current = ++this.current
                }).catch();
            } else {
                this.current = --this.current;
            }
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
    }
}