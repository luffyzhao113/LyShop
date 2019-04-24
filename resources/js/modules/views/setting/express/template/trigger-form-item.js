import Emitter from 'iview/src/mixins/emitter'

export default {
    name: "trigger-form-item",
    mixins: [Emitter],
    methods: {
        trigger(...items) {
            this.dispatch('FormItem', 'on-form-change', items);
        }
    },
    render(createElement, context) {
    }
}