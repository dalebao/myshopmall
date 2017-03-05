/**
 * Created by baoxulong on 2017/3/3.
 */

import Index from '../components/front/index.vue'
import UserLogin from '../components/utils/userLogin.vue'
import MainPage from '../components/front/mainPage.vue'
const routes = [
    {
        path: '/', component: Index,
        children:[
            {name:'index',path:'',component:MainPage,alias:'/index'}
        ]
    },
    {
        path: '/user-login', component: UserLogin
    }

]


export default routes