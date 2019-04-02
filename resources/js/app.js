import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './modules/index'
import store from "./modules/store/index"
import {router} from './modules/router/index'
import iView from 'iview'
import Fetch from './plugins/fetch'
import Cache from './plugins/cache'


Vue.use(Cache)
Vue.use(Fetch)
Vue.use(iView)
Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
})