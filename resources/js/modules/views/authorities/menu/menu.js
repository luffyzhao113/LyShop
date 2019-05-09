export default {
    data(){
        return {
            loading: true,
            data: {
                parent_id : this.props.id,
                parent: {name: '顶级菜单'},
                authorities: []
            },
            authorities: {
                data: []
            },
            ruleValidate: {
                name: [
                    {required: true, message: '菜单名称必须填写', trigger: 'blur'},
                    {type: 'string', min: 2, max: 20, message: '菜单名称字符长度是2-20个字符', trigger: 'blur'}
                ],
                url: [
                    {required: true, message: '菜单url必须填写', trigger: 'blur'},
                    {type: 'string', min: 2, max: 50, message: '菜单url字符长度是2-50个字符', trigger: 'blur'},
                ],
                sort: [
                    {required: true, type: 'number', message: '排序必须填写', trigger: 'blur'},
                    {type: 'number', min: 0, max: 99, message: '排序数值在0-99之间', trigger: 'blur'},
                ]
            }
        }
    },
    methods: {
        handleChange(newTargetKeys) {
            this.data.authorities = newTargetKeys
        }
    }
}