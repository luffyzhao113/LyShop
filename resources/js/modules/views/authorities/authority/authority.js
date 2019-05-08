export default {
    data(){
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
    }
}