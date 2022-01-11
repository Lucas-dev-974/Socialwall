import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/home.vue';
import Login from '../views/login.vue';
import WallModeration from '../views/wall_moderation.vue';

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
            path: '/wall-moderation',
            name: 'wall',
            component: WallModeration
        },
    
        { path: "*", component: Home }
    ],

})


export default router;
