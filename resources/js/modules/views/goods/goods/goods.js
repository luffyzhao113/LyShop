import {product} from "../../../../libs/util";

export default {
    data(){
        return {
            loading: true,
            data: {
                type: 'normal',
                status: 'undercarriage',
                stock: 0,
                weight: 0,
                categories: [],
                detail: {},
                galleries: [],
                specs: [],
                attributes: []
            },
            categories: {
                modal: false,
                wait: [],
                data: [],
            },
            config: {},
            units: {
                data: []
            },
            specs: {
                modal: false,
                data: [],
                wait: {},
                headers: []
            },
            attributes: {
                modal: false,
                wait: {},
                data: []
            },
            ruleValidate: {
                name: [
                    {required: true, message: '商品名称必须填写', trigger: 'blur'}
                ],
                price: [
                    {required: true, type: 'number', message: '商品价格必须填写', trigger: 'blur'}
                ],
                stock: [
                    {required: true, type: 'number', message: '商品库存必须填写', trigger: 'blur'}
                ],
                weight: [
                    {required: true, type: 'number', message: '商品重量必须填写', trigger: 'blur'}
                ],
                type: [
                    {required: true, message: '商品类型必须选择', trigger: 'change'}
                ],
                status: [
                    {required: true, message: '商品状态必须选择', trigger: 'change'}
                ],
                url: [
                    {required: true, message: '商品图片必须选择', trigger: 'change'}
                ],
                categories: [
                    {required: true, type: 'array', message: '商品分类必须选择', trigger: 'change'}
                ],
                galleries: [
                    {required: true, type: 'array', message: '商品组图必须选择', trigger: 'change'},
                ]
            },
        }
    },
    methods: {
        handleChangeCategory() {
            this.data.categories = this.categories.wait;
            this.categories.modal = false;
            this.dispatch('FormItem', 'on-form-change', this.data.categories);
        },
        handleChangeSpec() {
            let array = [];
            this.specs.headers = [];
            for (let waitKey in this.specs.wait) {
                let item = this.specs.wait[waitKey];
                if (item.length === 0) {
                    continue;
                }
                let arr = [];
                item.forEach(val => {
                    arr.push({
                        name: waitKey,
                        value: val
                    });
                });
                this.specs.headers.push(waitKey)
                array.push(arr)
            }
            if (array.length > (this.config.max_specs || 3)) {
                this.$Message.error('商品规格最多只能选择3个！')
            } else {
                this.data.specs = product(array);
                this.specs.modal = false;
            }
        },
        handleChangeAttribute() {
            let array = [];
            for (let waitKey in this.attributes.wait) {
                let item = this.attributes.wait[waitKey];
                if (item.length === 0) {
                    continue;
                }
                array.push({
                    name: waitKey,
                    values: item
                })
            }
            this.data.attributes = array;
            this.attributes.modal = false;
        },
        deleteSpec(index) {
            this.data.specs.splice(index, 1);
        },
        categoriesName(id) {
            return this.categories.data.find((v) => v.id === id)['title'];
        },
        setStock(val){
            if(Number.isInteger(val)){
                let stock = 0;
                this.data.specs.forEach((item) => {
                    if(!Number.isInteger(item.stock)){
                        return ;
                    }
                    stock += item.stock;
                });
                this.data.stock = stock;
            }
        }
    },
    filters: {
        join(val) {
            if (Array.isArray(val)) {
                return val.join();
            }
            return val;
        }
    }
}