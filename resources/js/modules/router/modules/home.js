export const home = [
    {
        path: 'index',
        name: 'home',
        meta: {
            title: '首页',
            cache: true,
            tags: true
        },
        component: () => import('./../../views/index/index')
    },
    {
        path: 'profile',
        name: 'profile',
        meta: {
            title: '个人中心',
            cache: true,
            tags: true
        },
        component: () => import('./../../views/profile/index')
    },
    {
        path: 'setting/spec',
        name: 'setting.spec',
        meta: {
            title: '商品规格',
            cache: true,
            tags: true
        },
        component: () => import('./../../views/setting/spec/index')
    },
    {
        path: 'Authorities/user',
        name: 'authorities.user',
        meta: {
            title: '用户管理',
            cache: true,
            tags: true
        },
        component: () => import('./../../views/authorities/user/index')
    },
    {
        path: 'Authorities/role',
        name: 'authorities.role',
        meta: {
            title: '部门管理',
            cache: true,
            tags: true
        },
        component: () => import('./../../views/authorities/role/index')
    },
    {
        path: 'Authorities/menu',
        name: 'authorities.menu',
        meta: {
            title: '菜单管理',
            cache: true,
            tags: true
        },
        component: () => import('./../../views/authorities/menu/index')
    },
    {
        path: 'Authorities/authority',
        name: 'authorities.authority',
        meta: {
            title: '权限管理',
            cache: true,
            tags: true
        },
        component: () => import('./../../views/authorities/authority/index')
    },
    {
        path: 'Setting/express',
        name: 'setting.express',
        meta: {
            title: '快递设置',
            cache: true,
            tags: true
        },
        component: () => import('./../../views/setting/express/index')
    }
]