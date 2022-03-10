import Vue from 'vue';
import Layout from './layout.vue';
import router from './services/router'
import Vuetify from 'vuetify'
import  Store  from './services/Storage';

import VueFusionCharts from 'vue-fusioncharts';
import FusionCharts from 'fusioncharts';
import Column2D from 'fusioncharts/fusioncharts.charts';
import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion';

Vue.use(VueFusionCharts, FusionCharts, Column2D, FusionTheme)
Vue.use(Vuetify)

const app = new Vue({
    el: '#app',
    router: router,
    store: Store,
    vuetify: new Vuetify(),
    components: { Layout },
});

export default new Vuetify(app);