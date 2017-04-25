/**
 * Created by baoxulong on 2017/3/3.
 */
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// import Detail from '../components/front/detail.vue'
// import NewOrder from '../components/front/newOrder.vue'
const Index = r => require.ensure(['../components/front/index.vue'], () => r(require('../components/front/index.vue')), 'group-index')
const Detail = r => require.ensure(['../components/front/detail.vue'], () => r(require('../components/front/detail.vue')), 'group-index')
const NewOrder = r => require.ensure(['../components/front/newOrder.vue'], () => r(require('../components/front/newOrder.vue')), 'group-index')
const MainPage = r => require.ensure(['../components/front/mainPage.vue'], () => r(require('../components/front/mainPage.vue')), 'group-index')
const Category = r => require.ensure(['../components/front/category.vue'], () => r(require('../components/front/category.vue')), 'group-index')

const UserLogin = r => require.ensure(['../components/utils/userLogin.vue'], () => r(require('../components/utils/userLogin.vue')), 'group-login')
const AdminLogin = r => require.ensure(['../components/utils/adminLogin.vue'], () => r(require('../components/utils/adminLogin.vue')), 'group-login')
const UserRegister = r => require.ensure(['../components/utils/userRegister.vue'], () => r(require('../components/utils/userRegister.vue')), 'group-login')
const AdminRegister = r => require.ensure(['../components/utils/adminRegister.vue'], () => r(require('../components/utils/adminRegister.vue')), 'group-login')


const UserAdmin = r => require.ensure(['../components/frontAdmin/admin.vue'], () => r(require('../components/frontAdmin/admin.vue')), 'group-frontAdmin')
const UserSetting = r => require.ensure(['../components/frontAdmin/UserSetting.vue'], () => r(require('../components/frontAdmin/UserSetting.vue')), 'group-frontAdmin')
const ShowOrders = r => require.ensure(['../components/frontAdmin/showOrders.vue'], () => r(require('../components/frontAdmin/showOrders.vue')), 'group-frontAdmin')


const BackEndIndex = r => require.ensure(['../components/backend/index.vue'], () => r(require('../components/backend/index.vue')), 'group-backendAdmin')
const Dash = r => require.ensure(['../components/backend/dash.vue'], () => r(require('../components/backend/dash.vue')), 'group-backendAdmin')
const ItemList = r => require.ensure(['../components/backend/listItem.vue'], () => r(require('../components/backend/listItem.vue')), 'group-backendAdmin')
const OrderList = r => require.ensure(['../components/backend/orderList.vue'], () => r(require('../components/backend/orderList.vue')), 'group-backendAdmin')
const ItemAdd = r => require.ensure(['../components/backend/itemAdd.vue'], () => r(require('../components/backend/itemAdd.vue')), 'group-backendAdmin')
const ItemEdit = r => require.ensure(['../components/backend/itemEdit.vue'], () => r(require('../components/backend/itemEdit.vue')), 'group-backendAdmin')
const ItemProfit = r => require.ensure(['../components/backend/itemProfit.vue'], () => r(require('../components/backend/itemProfit.vue')), 'group-backendAdmin')


// import UserAdmin from '../components/frontAdmin/admin.vue'
// import UserSetting from '../components/frontAdmin/UserSetting.vue'
// import ShowOrders from '../components/frontAdmin/showOrders.vue'
// import BackEndIndex from '../components/backend/index.vue'
// import Dash from '../components/backend/dash.vue'
// import ItemList from '../components/backend/listItem.vue'
// import OrderList from '../components/backend/orderList.vue'
// import ItemAdd from '../components/backend/itemAdd.vue'
// import ItemEdit from '../components/backend/itemEdit.vue'
// import ItemProfit from '../components/backend/itemProfit.vue'
// import UserLogin from '../components/utils/userLogin.vue'
// import AdminLogin from '../components/utils/adminLogin.vue'
// import UserRegister from '../components/utils/userRegister.vue'
// import AdminRegister from '../components/utils/adminRegister.vue'
// import MainPage from '../components/front/mainPage.vue'
// import Category from '../components/front/category.vue'

const routes = [
    {
        path: '/', component: Index,
        children: [
            {name: 'index', path: '', component: MainPage, alias: '/index'},
            {name: 'category', path: 'category', component: Category},
            {name: 'detail', path: 'detail/:itemId', component: Detail},
            {name: 'newOrder', path: 'neworder/:itemId/:itemNum', meta: {requireAuth: true}, component: NewOrder}
        ]
    },
    {
        name: 'user-login', path: '/user-login', component: UserLogin
    },
    {
        name: 'user-register', path: '/user-register', component: UserRegister
    },
    {
        name: 'admin-register', path: '/admin-register', component: AdminRegister
    },
    //user admin end route
    {
        path: '/user-admin', meta: {requireAuth: true}, component: UserAdmin,
        children: [
            {
                name: 'user-admin-setting',
                path: '',
                component: UserSetting, meta: {requireAuth: true},
                alias: '/user-admin/index'
            },
            {
                name: 'user-admin-showOrders',
                path: 'show_orders',
                component: ShowOrders, meta: {requireAuth: true},
                alias: '/user-admin/show-orders'
            }

        ]
    },
    //haso route
    {
        path: '/haso', meta: {requireAdminAuth: true}, component: BackEndIndex,
        children: [
            {
                name: 'dash', path: '/', meta: {requireAdminAuth: true}, component: Dash
            },
            {
                name: 'item_add', path: 'item_add', meta: {requireAdminAuth: true}, component: ItemAdd
            },
            {
                name: 'item_list', path: 'item_list', meta: {requireAdminAuth: true}, component: ItemList
            },
            {
                name: 'item_edit', path: 'item_edit/:itemId', meta: {requireAdminAuth: true}, component: ItemEdit
            },
            {
                name: 'order_list', path: 'order_list', meta: {requireAdminAuth: true}, component: OrderList
            },
            {
                name: 'item_profit', path: 'item_profit', meta: {requireAdminAuth: true}, component: ItemProfit
            }
        ]
    },
    //admin login page
    {
        name: 'admin-login', path: '/admin-login', component: AdminLogin
    }

];


const router = new VueRouter({
    mode: 'history',
    routes: routes
})

router.beforeEach((to, from, next) => {
    //用户层认证判断
    if ((to.meta.requireAuth)) {// 判断该路由是否需要登录权限
        if (sessionStorage.getItem('user-email')) {//判断是否登录
            next()
        } else {
            if (to.fullPath == '/user-login') {
                next();
            } else {
                next({path: '/user-login'});
            }
        }
    } else {
        if (sessionStorage.getItem('user-email')) {
            if (to.fullPath == '/user-login') {
                next({
                    query: {redirect: from.fullPath}
                })
            }

        }
    }

    //管理层认证判断
    if ((to.meta.requireAdminAuth)) {// 判断该路由是否需要登录权限
        var sessionAdmin = sessionStorage.getItem('admin-email')
        if (sessionAdmin != undefined && sessionAdmin != '') {//判断是否登录
            next()
        } else {
            if (to.fullPath == '/admin-login') {
                next();
            } else {
                next({path: '/admin-login'});
            }
        }
    } else {
        if (sessionAdmin != undefined && sessionAdmin != '') {
            if (to.fullPath == '/admin-login') {
                next({
                    query: {redirect: from.fullPath}
                })
            } else {
                next();
            }

        }
        next();
    }

});


export default router