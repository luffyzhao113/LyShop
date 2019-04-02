import fromSubmit from './from-submit'

export default {
    mixins: [fromSubmit],
    data(){
        return {
            page: {
                current: 1,
                total: 100
            },
            table: {
                columns: [],
                data: []
            },
            component: {
                is: '',
                prop: null
            },
            loading: true
        }
    },
    mounted(){
        this.$nextTick(() => {
            this.getLists();
        });
    },
    methods: {
        pageChange(v){
            this.getLists(v);
        },
        openComponent(is, prop = null){
            this.component.is = is;
            this.component.prop = prop;
        },
        closeComponent(){
            this.component.is = '';
            this.component.prop = null;
        },
        getLists(){}
    }
}