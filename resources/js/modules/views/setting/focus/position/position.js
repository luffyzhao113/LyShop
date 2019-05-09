export default {
    data(){
        return {
            loading: false,
            data: {},
            ruleValidate: {
                name: [
                    {required: true, message: '位置名称必须填写', trigger: 'blur'},
                    {type: 'string', min: 2, max: 50, message: '焦点图位置名称字符长度是2-50个字符', trigger: 'blur'}
                ],
                description: [
                    {max: 255, message: '位置说明最多支持255个字符', trigger: 'blur'}
                ]
            }
        }
    },
}