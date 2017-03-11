/**
 * Created by baoxulong on 2017/3/3.
 */
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Index from '../components/front/index.vue'
import UserLogin from '../components/utils/userLogin.vue'
import UserRegister from '../components/utils/userRegister.vue'
import MainPage from '../components/front/mainPage.vue'
import Category from '../components/front/category.vue'
import UserAdmin from '../components/frontAdmin/admin.vue'
import BackAdmin from '../components/backendAdmin/backAdmin.vue'
import AdminLogin from '../components/utils/adminLogin.vue'
import AdminRegister from'../components/utils/adminRegister.vue'


const routes = [
    {
        path: '/', component: Index,
        children: [
            {name: 'index', path: '', component: MainPage, alias: '/index'},
            {name: 'category', path: 'category', component: Category}
        ]
    },
    {
        path: '/haso', component: BackAdmin
    },
    {
        name: 'user-login', path: '/user-login', component: UserLogin
    },
    {
        name: 'admin-login', path: '/admin-login', component: AdminLogin
    },
    {
        name: 'admin-register', path: '/admin-register', component: AdminRegister
    },
    {
        name: 'user-register', path: '/user-register', component: UserRegister
    },
    {
        name: 'user-admin', path: '/user-admin', meta: {requireAuth: true}, component: UserAdmin
    }

];


const router = new VueRouter({
    mode: 'history',
    routes: routes
})

router.beforeEach((to, from, next) => {

    if ((to.meta.requireAuth)) {// 判断该路由是否需要登录权限
        if (sessionStorage.getItem('user-email')) {//判断是否登录
            next()
        } else {
            if ((to.fullPath == '/user-login') || (to.fullPath == '/user-register')) {
                next();
            } else {
                next({path: '/user-login'});
            }
        }
    } else {
        if (sessionStorage.getItem('user-email')) {
            if ((to.fullPath == '/user-login') || (to.fullPath == '/user-register')) {
                next({
                    query: {redirect: from.fullPath}
                })
            }

        }
        next();
    }


});


export default router