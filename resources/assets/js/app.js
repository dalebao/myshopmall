/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import App from './App.vue'
// import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-default/index.css';
import router from './router/router.js'

import iView from 'iview'
import 'iview/dist/styles/iview.css';

Vue.use(ElementUI)


Vue.use(iView)





const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
