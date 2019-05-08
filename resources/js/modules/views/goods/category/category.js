export default {
    data(){
        return {
            loading: false,
            data: {
                parent_id: this.props.id,
                status: 'off',
                search_filters: [{
                    name: '',
                    values: []
                }]
            },
            positions: {data: []},
            filter: {show: false, index: undefined, value: undefined},
            ruleValidate: {
                name: [
                    {required: true, message: '名称必须填写', trigger: 'blur'},
                    {type: 'string', min: 2, max: 50, message: '名称字符长度是2-50个字符', trigger: 'blur'}
                ],
                parent_id: [
                    {required: true, message: '上级类目必须填写', trigger: 'change'},
                ],
                sort: [
                    {required: true, type: 'number', message: '排序必须选择', trigger: 'blur'}
                ],
                description: [
                    {max: 255, message: '位置说明最多支持255个字符', trigger: 'blur'}
                ],
                status: [
                    {required: true, message: '状态必须选择', trigger: 'change'}
                ]
            }
        }
    },
    methods: {
        handleChangeOk() {
            if (this.filter.value) {
                if (!oneOf(this.filter.value, this.data.search_filters[this.filter.index].values)) {
                    this.data.search_filters[this.filter.index].values.push(
                        this.filter.value
                    );
                    this.filter.value = undefined;
                    this.filter.show = false;
                    return;
                }
            }
            this.$Message.warning('属性值已存在或者属性值不能为空！');
        },
        add(index) {
            this.filter.index = index;
            this.filter.show = true;
        },
        close(values, index) {
            values.splice(index, 1);
        },
        addAreaItem(search_filters) {
            search_filters.push({
                name: '',
                values: []
            })
        },
        remove(search_filters, index) {
            search_filters.splice(index, 1);
        }
    }
}