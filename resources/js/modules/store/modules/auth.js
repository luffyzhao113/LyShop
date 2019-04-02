import auth from '../../api/auth'
import {$cache} from '../../../plugins/cache/index'

export default {
    namespaced: true,
    state: {
        login: false,
        // 用户菜单
        menus: []
    },
    getters: {
        login: state => {
            return $cache.get('auth/token') || state.login
        },
        menus: state => {
            return $cache.get('auth/menus') || state.menus
        },
    },
    mutations: {
        setLogin(state, status) {
            state.login = status
        },
        setMenus(state, menus) {
            state.menus = menus
        }
    },
    actions: {
        afterLogin({commit}, token) {
            $cache.set('auth/token', token);
            commit('setLogin', true);
            // 这里要请求后台接口
            setTimeout(() => {
                let menus = [{
                    name: '首页',
                    link: 'home',
                    icon: 'ios-home-outline'
                }, {
                    name: '商城设置',
                    link: 'setting',
                    icon: 'md-ribbon',
                    children: [
                        {
                            name: '商品规格',
                            link: 'setting.spec',
                            icon: 'md-ribbon',
                        }
                    ]
                }, {
                    name: '后台用户',
                    link: 'authorities',
                    icon: 'md-ribbon',
                    children: [
                        {
                            name: '用户管理',
                            link: 'authorities.user',
                            icon: 'md-ribbon',
                        },
                        {
                            name: '权限组',
                            link: 'authorities.role',
                            icon: 'md-ribbon',
                        },
                        {
                            name: '权限管理',
                            link: 'authorities.authority',
                            icon: 'md-ribbon',
                        },
                        {
                            name: '菜单管理',
                            link: 'authorities.menu',
                            icon: 'md-ribbon',
                        }
                    ]
                }, {
                    name: '个人中心',
                    link: 'profile',
                    icon: 'md-ribbon',
                }];
                $cache.set('auth/menus', menus);
                commit('setMenus', menus);
            }, 1000);

        },
        afterLogout({commit}) {
            $cache.clear();
            commit('setLogin', false);
            commit('setMenus', []);
        }
    }
}