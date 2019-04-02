import fromSubmit from './from-submit'

export default {
    mixins: [fromSubmit],
    props:{
        props: null
    },
    data(){
        return {
            drawer: {
                value: true
            }
        }
    },
    methods: {
        closeDrawer(v){
            if(v === false){
                this.drawer.value = false;
                this.drawer.props = null;
                this.$emit('on-close', false);
                this.$emit('on-refresh')
            }
        }
    }
}