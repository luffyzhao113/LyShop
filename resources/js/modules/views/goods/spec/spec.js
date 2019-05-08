export default {
    data(){
        return {
            loading: false,
            data: {},
            ruleValidate: {
                name: [
                    {required: true, message: '名称必须填写', trigger: 'blur'},
                    {type: 'string', min: 2, max: 20, message: '名称字符长度是2-20个字符', trigger: 'blur'}
                ],
                values: [
                    {required: true, type: 'array', message: '属性值必须填写', trigger: 'blur'}
                ],
                type: [
                    {required: true,  message: '类型必须填写', trigger: 'blur'}
                ],
                description: [
                    {max: 255, message: '属性描述字符长度最多255个字条', trigger: 'blur'}
                ]
            }
        }
    }
}