import VueRouter from 'vue-router'
import {home} from "./modules/home";
import {common} from "./modules/common";
import {loyout} from "./modules/layout";
import store from "../store/index"


export const router = new VueRouter({
    routes: [{
        path: '/admin',
        name: 'admin',
        component: () => import('../components/layout/main'),
        children: [
            ...home
        ]
    },
        ...common,
        ...loyout
    ]
});

router.beforeEach((to, from, next) => {
    let isLogin = store.getters['auth/login'];
    if(to.name === 'login' && Boolean(isLogin)){
        next({name: 'home'})
    }else if(to.name !== 'login' && !Boolean(isLogin) ){
        next({name: 'login'})
    }else{
        next()
    }
});


router.afterEach((to, from) => {
    store.dispatch('layout/open', to);
})