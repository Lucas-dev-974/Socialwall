import Vue from 'vue';
import Layout from './layout.vue';
import router from './services/router'
import Vuetify from 'vuetify'
import  Store  from './services/Storage';

Vue.use(Vuetify)

const app = new Vue({
    el: '#app',
    router: router,
    store: Store,
    vuetify: new Vuetify(),
    components: { Layout },
});

export default new Vuetify(app);