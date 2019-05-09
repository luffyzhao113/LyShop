export default {
    data() {
        return {
            loading: true,
            fileLoading: false,
            data: {
                file: undefined,
                status: 'off'
            },
            positions: {data: []},
            file: {
                error: undefined
            },
            ruleValidate: {
                name: [
                    {required: true, message: '名称必须填写', trigger: 'blur'},
                    {type: 'string', min: 2, max: 50, message: '焦点图位置名称字符长度是2-50个字符', trigger: 'blur'}
                ],
                position_id: [
                    {required: true, type: 'number', message: '焦点图位置必须选择', trigger: 'change'}
                ],
                sort: [
                    {required: true, type: 'number', message: '焦点图排序必须选择', trigger: 'blur'}
                ],
                status: [
                    {required: true, message: '焦点图状态必须选择', trigger: 'change'}
                ],
                description: [
                    {max: 255, message: '位置说明最多支持255个字符', trigger: 'blur'}
                ],
                file: [
                    {max: 255, message: '图片必须上传', trigger: 'change', required: true}
                ],
                url: [
                    {required: true, message: '跳转链接必须填写', trigger: 'blur'}
                ]
            }
        }
    },
}