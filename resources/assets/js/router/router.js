/**
 * Created by baoxulong on 2017/3/3.
 */
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Index from '../components/front/index.vue'
import Detail from '../components/front/detail.vue'
import NewOrder from '../components/front/newOrder.vue'
import UserLogin from '../components/utils/userLogin.vue'
import AdminLogin from '../components/utils/adminLogin.vue'
import UserRegister from '../components/utils/userRegister.vue'
import AdminRegister from '../components/utils/adminRegister.vue'
import MainPage from '../components/front/mainPage.vue'
import Category from '../components/front/category.vue'
import UserAdmin from '../components/frontAdmin/admin.vue'
import UserSetting from '../components/frontAdmin/UserSetting.vue'
import ShowOrders from '../components/frontAdmin/showOrders.vue'
import BackEndIndex from '../components/backend/index.vue'
import Dash from '../components/backend/dash.vue'
import ItemList from '../components/backend/listItem.vue'
import OrderList from '../components/backend/orderList.vue'
import ItemAdd from '../components/backend/itemAdd.vue'
import ItemEdit from '../components/backend/itemEdit.vue'
import ItemProfit from '../components/backend/itemProfit.vue'


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
                alias:'/user-admin/show-orders'
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
                name:'order_list',path:'order_list',meta: {requireAdminAuth: true},component:OrderList
            },
            {
                name:'item_profit',path:'item_profit',meta: {requireAdminAuth: true},component:ItemProfit
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