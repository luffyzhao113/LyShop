import Vuex from 'vuex'
import Vue from 'vue'
import layout from "./modules/layout";
import auth from "./modules/auth";

Vue.use(Vuex);


const store = new Vuex.Store({
    modules: {
        layout,
        auth
    },
    strict: process.env.NODE_ENV !== 'production'
})

export default store;