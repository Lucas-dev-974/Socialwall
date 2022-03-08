import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from '../views/login.vue';
import Register from '../views/register.vue';
import WallModeration from '../views/wall_moderation.vue';
import Wall from '../views/wall.vue';
import Dashboard from '../views/Dashboard.vue'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/login', name: 'login', component: Login, },

        { path: '/register', name: 'register', component: Register },

        { path: '/moderation', name: 'moderation', component: WallModeration },

        { path: '/dashboard', name: 'dashboard', component: Dashboard },

        { path: '/wall', name: 'wall', component: Wall },
    
        { path: "*", component: Dashboard }
    ],

})


export default router;
