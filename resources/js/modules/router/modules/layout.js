export const loyout = [
    {
        path: '/',
        name: 'login',
        meta: {
            title: '登录',
            cache: false
        },
        component: () => import('../../views/layout/login.vue')
    },
    {
        path: '*',
        name: 'common.error-404',
        meta: {
            title: '404-页面不存在',
            cache: true
        },
        component: () => import('../../components/layout/error.vue')
    },
]