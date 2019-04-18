import {$cache} from '../../../plugins/cache'

let state = {
    // 活动的标签导航
    active: '',
    // 全部的标签导航
    inactives: []
};

let layout = $cache.get('$store/layout') || {};

state.inactives = layout.inactives || [];
state.active = layout.active || '';

export default {
    namespaced: true,
    state,
    getters: {
        /**
         * 全部的标签导航
         */
        inactives: state => {
            return state.inactives
        },
        /**
         * 活动的标签导航
         */
        active: state => {
            return state.active
        }
    },
    mutations: {
        /**
         * 添加标签导航
         * @param {新标签} newRoute 
         */
        newTag(state, { name, path, meta }) {
            if (meta.tags === true && state.inactives.findIndex(item => item.name === name) === -1) {
                state.inactives.push({ name, path, meta })
            }
        },
        /**
         * 删除某个标签导航
         * @param {state} state 
         * @param {路由name} name 
         */
        removeTag(state, name) {
            let index = -1;
            if ((index = state.inactives.findIndex(item => item.name === name)) !== -1) {
                if (index !== 0) {
                    state.inactives.splice(index, 1)
                    if(name === state.active){
                        if(index === state.inactives.length){
                            index = index - 1;
                        }
                        state.active = state.inactives[index].name
                    }
                }
            }
        },
        /**
         * 删除全部标签导航
         * @param {*} state 
         */
        removeAll(state) {
            state.inactives.splice(1, state.inactives.length - 1);
            state.active = state.inactives[0].name
        },
        /**
         * 删除其他导航标签
         * @param {} state 
         */
        removeOther(state){
            state.inactives = state.inactives.filter(({name}, key) => {
                return key === 0 || name === state.active
            })
        },
        /**
         * 设置当前活动的标签导航
         * @param {*} state 
         */
        setActive(state, { name, path, meta }) {
            state.active = name
        },
        /**
         * 保存到本地数据库
         */
        setLocal(state){
            $cache.set('$store/layout', state)
        },
        /**
         * 初始设置
         * @param {*} state 
         */
        init(state){
            let $state = $cache.get('$store/layout')
            if($state.active !== '' && $state.inactives.length > 0){
                for (const key in $state) {
                    if ($state.hasOwnProperty(key)) {
                        const element = $state[key];
                        state[key] = element
                    }
                }
            }
        }
    },
    actions: {
        /**
         * 打开页面
         * @param {*} param0 
         * @param {路由} tag 
         */
        open({ commit }, tag) {
            commit('newTag', tag)
            commit('setActive', tag)
            commit('setLocal')
        },
        /**
         * 删除页面
         * @param {*} param0 
         * @param {*} name 
         */
        remove({ commit }, name) {
            commit('removeTag', name)
            commit('setLocal')
        },
        /**
         * 删除所有
         * @param {*} param0 
         */
        removeAll({ commit }){
            commit('removeAll')
            commit('setLocal')
        },
        /**
         * 删除其他
         * @param {*} param0 
         */
        removeOther({ commit }){
            commit('removeOther')
            commit('setLocal')
        },
        /**
         * 初始设置
         * @param {*} param0 
         */
        init({ commit , state , dispatch}, home){
            commit('init')
            if(state.active === ''){
                dispatch('open', home)
            }
        }
    }
}