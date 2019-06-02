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
        path: 'Setting/express/company',
        name: 'setting.express.company',
        meta: {
            title: '快递公司',
            cache: true,
            tags: true
        },
        component: () => import('../../views/setting/express/company')
    },
    {
        path: 'Setting/express/template',
        name: 'setting.express.template',
        meta: {
            title: '快递模板',
            cache: true,
            tags: true
        },
        component: () => import('../../views/setting/express/template')
    },
    {
        path: 'Setting/shop',
        name: 'setting.shop',
        meta: {
            title: '店铺管理',
            cache: true,
            tags: true
        },
        component: () => import('../../views/setting/shop')
    },
    {
        path: 'Setting/focus',
        name: 'setting.focus',
        meta: {
            title: '焦点图管理',
            cache: true,
            tags: true
        },
        component: () => import('../../views/setting/focus')
    },
    {
        path: 'Setting/focus/position',
        name: 'setting.focus.position',
        meta: {
            title: '焦点图位置管理',
            cache: true,
            tags: true
        },
        component: () => import('../../views/setting/focus/position')
    },
    {
        path: 'Goods/category',
        name: 'goods.category',
        meta: {
            title: '类目管理',
            cache: true,
            tags: true
        },
        component: () => import('../../views/goods/category')
    }, {
        path: 'Goods/spec',
        name: 'goods.spec',
        meta: {
            title: '商品属性',
            cache: true,
            tags: true
        },
        component: () => import('../../views/goods/spec')
    }, {
        path: 'Goods/list',
        name: 'goods.list',
        meta: {
            title: '商品列表',
            cache: true,
            tags: true
        },
        component: () => import('../../views/goods/goods')
    }, {
        path: 'Goods/recycle',
        name: 'goods.recycle',
        meta: {
            title: '商品回收站',
            cache: true,
            tags: true
        },
        component: () => import('../../views/goods/goods/recycle.vue')
    }, {
        path: 'Goods/show',
        name: 'goods.show',
        meta: {
            title: '商品详情',
            cache: true,
            tags: true
        },
        component: () => import('../../views/goods/goods/show.vue')
    }
]