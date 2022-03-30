import Vue       from 'vue';
import VueRouter from 'vue-router';

// Authentication Pages
import ResetPassword  from '../views/Authentication/ResetPassword.vue'
import Register       from '../views/Authentication/register.vue';
import Login          from '../views/Authentication/login.vue';

// Pages
import Moderation     from '../views/Moderation.vue';
import Wall           from '../views/wall.vue';
import Dashboard      from '../views/Dashboard.vue'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/login', name: 'login', component: Login, },

        { path: '/register', name: 'register', component: Register },

        { path: '/reset-password/:token', name: 'reset-password', component: ResetPassword },

        { path: '/moderation', name: 'moderation', component: Moderation },

        { path: '/dashboard', name: 'dashboard', component: Dashboard },

        { path: '/wall', name: 'wall', component: Wall },
    
        { path: "*", component: Dashboard }
    ],

})


export default router;
