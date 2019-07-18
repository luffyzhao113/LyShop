import axios from 'axios'
import {$cache} from '../cache/index'
import $store from '../../modules/store/index'
import {Message} from 'iview'

const instance = axios.create({
    baseURL: '/api/',
    timeout: 10000
});

// 添加请求拦截器
instance.interceptors.request.use((config) => {
    // 在发送请求之前做些什么
    config.headers = {
        'Accept': 'application/json'
    }
    let $token = $cache.get('$store/auth/token');
    if ($token) {
        config.headers['authorization'] = 'bearer ' + $token;
    }

    return config;
}, (error) => {
    // 对请求错误做些什么
    return Promise.reject(error);
});

// 添加响应拦截器
instance.interceptors.response.use((response) => {
    // 对响应数据做点什么
    return response.data;
}, (error) => {
    if(!error.response){
        Message.error('网络加载失败！');
    }else if(error.response.status === 401){
        Message.error('登录失效,请重新登录！');
        $store.dispatch('auth/afterLogout');
    }else if(error.response.status === 403){
        Message.error(error.response.data.message);
    }else if(error.response.status === 422){
        Message.error('数据验证错误，请检查提交的数据!');
    }else if(error.response.status === 404){
        Message.error('数据不存在!');
    }else{
        Message.error('服务器错误,请联系管理员!');
    }
    return Promise.reject(error.response);
});


export default {
    install(Vue) {
        Vue.prototype.$http = instance;
        Vue.http = instance;
    }
}

export const $http = instance;