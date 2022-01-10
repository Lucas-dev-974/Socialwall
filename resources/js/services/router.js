import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/home.vue';
import Login from '../views/login.vue';
import Dashboard from '../views/dashboard.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/admin',
            name: 'admin',
            component: Dashboard
        },
    
        { path: "*", component: Home }
    ],

})


export default router;
