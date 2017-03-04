/**
 * Created by baoxulong on 2017/3/3.
 */

import Index from '../components/front/index.vue'
import UserLogin from '../components/utils/userLogin.vue'
const routes = [
    {
        path: '/', component: Index
    },
    {
        path: '/user-login', component: UserLogin
    }

]


export default routes