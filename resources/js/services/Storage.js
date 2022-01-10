import Vuex from 'vuex' 
import VuePersist from 'vuex-persist'
import Vue from 'vue'
import ApiServices from './ApiServices'
import router from './router'

Vue.use(Vuex)

const vuexLocal = new VuePersist({
    storage: window.localStorage
})

export default new Vuex.Store({
    plugins: [vuexLocal.plugin],

    state: {
        posts: [],
        validated_posts: [],
        recaled_posts: [],
        token: null,
        settings: {
            hashtag: null,
            InstagramAccountID: null,
            facecbookID: null,
        }
    },

    mutations: {
        set_posts: function(state, posts){

        },

        set_token: function(state, token){
            console.log('in storage, store token: ', token);
            state.token = token
        },


    },
})