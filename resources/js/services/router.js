import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/home.vue';
import Login from '../views/login.vue';
import Register from '../views/register.vue';
import WallModeration from '../views/wall_moderation.vue';
import Wall from '../views/wall.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: WallModeration,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },

        {
            path: '/wall',
            name: 'wall',
            component: Wall
        },
    
        { path: "*", component: WallModeration }
    ],

})


export default router;
