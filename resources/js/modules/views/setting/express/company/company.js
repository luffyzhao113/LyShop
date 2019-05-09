export default {
    data() {
        return {
            loading: false,
            data: {
                view: 'no',
                code: ''
            },
            ruleValidate: {
                name: [
                    {required: true, message: '快递公司名称必须填写', trigger: 'blur'},
                    {type: 'string', min: 2, max: 50, message: '快递公司名称字符长度是2-50个字符', trigger: 'blur'}
                ],
                view: [
                    {required: true, message: '是否支持查看物流轨迹必须选择', trigger: 'change'},
                ],
                code: [
                    {
                        validator: (rule, value, callback) => {
                            if ((this.data.view === 'yes' && value !== '') || this.data.view === 'no') {
                                return callback();
                            } else {
                                return callback('物流接口编号必须填写');
                            }
                        }, message: '物流接口编号必须填写', trigger: 'blur'
                    }
                ],
                description: [
                    {max: 255, message: '快递公司简介最多支持255个字符', trigger: 'blur'}
                ]
            }
        }
    },
}