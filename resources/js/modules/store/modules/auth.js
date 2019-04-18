import {$cache} from '../../../plugins/cache/index'
import {router} from '../../router/index'
import {listConvertTree} from "../../../libs/util";
import {$http} from "../../../plugins/fetch";

let state = {
    login: null,
    // 用户菜单
    menus: []
};
state.login = $cache.get('$store/auth/token');
state.menus = $cache.get('$store/auth/menus');

export default {
    namespaced: true,
    state,
    getters: {
        login: state => {
            return state.login
        },
        menus: state => {
            return state.menus
        },
    },
    mutations: {
        setLogin(state, status) {
            state.login = status
            $cache.set('$store/auth/token', status);
        },
        setMenus(state, menus) {
            state.menus = menus;
            $cache.set('$store/auth/menus', menus);
        }
    },
    actions: {
        afterLogin({commit}, data) {
            commit('setLogin', data.token);
            commit('setMenus', listConvertTree(data.menus));
            router.push({name: 'home'})
        },
        afterLogout({commit}) {
            $cache.clear();
            commit('setLogin', false);
            commit('setMenus', []);
            router.push({name: 'login'})
        },
        refresh({commit, dispatch}){
            $http.put('refresh').then((res) => {
                commit('setLogin', res.data);
            });
        }
    }
}