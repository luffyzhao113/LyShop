import axios from 'axios'
import {$cache} from '../cache/index'

const instance = axios.create({
    baseURL: 'http://127.0.0.1/api/',
    timeout: 10000
});

// 添加请求拦截器
instance.interceptors.request.use((config) => {
    // 在发送请求之前做些什么
    config.headers = {
        'Accept': 'application/json'
    }
    let $token = $cache.get('auth/token');
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
    return Promise.reject(error);
});


export default {
    install(Vue) {
        Vue.prototype.$http = instance
        Vue.http = instance
    }
}

export const $http = instance