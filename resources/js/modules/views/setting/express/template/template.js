export default {
    data() {
        return {
            loading: true,
            data: {
                view: 'no',
                status: 'off',
                type: 'piece',
                company_id: undefined,
                details: [
                    {
                        areas: [],
                        first: 0.00,
                        first_fee: 0.00,
                        continue: 0.00,
                        continue_fee: 0.00,
                    }
                ]
            },
            areas: {data: [], modal: false, index: undefined, wait: []},
            companies: {data: []},
            ruleValidate: {
                name: [
                    {required: true, message: '模板名称必须填写', trigger: 'blur'},
                    {type: 'string', min: 2, max: 50, message: '模板名称字符长度是2-50个字符', trigger: 'blur'}
                ],
                type: [
                    {required: true, message: '模板类型必须选择', trigger: 'change'}
                ],
                status: [
                    {required: true, message: '模板状态必须选择', trigger: 'change'}
                ],
                company_id: [
                    {
                        trigger: 'change',
                        required: true,
                        type: 'number',
                        message: '快递公司必须选择'
                    }
                ],
            }
        }
    },
    methods: {
        addAreaItem() {
            this.update.details.push({
                areas: [],
                first: 0.00,
                first_fee: 0.00,
                continue: 0.00,
                continue_fee: 0.00,
            });
        },
        remove(item) {
            this.update.details.splice(item, 1);
        },
        openAreasModal(index) {
            this.areas.index = index;
            this.areas.wait = this.update.details[this.areas.index].areas;
            this.updateAreas(index);
            this.areas.modal = true;
        },
        render(item) {
            return item.label;
        },
        showAreaName(id) {
            return this.areas.data.find(val => val.key === id)['label'];
        },
        showAreaNames(items) {
            if (items.length > 2) {
                return this.showAreaName(items[0]) + ` 等 ${items.length} 个城市`;
            } else if (items.length > 0) {
                let str = '';
                items.forEach(val => {
                    str += ' ' + this.showAreaName(val) + ',';
                });
                return str.substr(0, str.length - 1);
            }
        },
        handleChange(newTargetKeys) {
            this.areas.wait = newTargetKeys;
        },
        handleChangeOk() {
            this.update.details[this.areas.index].areas = this.areas.wait;
            this.areas.modal = false;
            this.$refs['details.areas'][this.areas.index].trigger(this.update.details[this.areas.index].areas)
        },
        updateAreas(index) {
            let changeAreas = [];
            this.update.details.forEach(({areas}, key) => {
                if (index !== key)
                    changeAreas = changeAreas.concat(areas);
            });
            this.areas.data.map((item, index) => {
                if (changeAreas.find(val => item.key === val)) {
                    item.disabled = true;
                } else {
                    item.disabled = false
                }
            })
        }
    }
}