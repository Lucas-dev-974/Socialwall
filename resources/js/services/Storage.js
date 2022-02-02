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
        validated_posts: [],
        blocked_posts: [],
        token: null,
        FBDatas: null,
        UserDatas: null,
        settings: {
            hashtag: 'test',
            InstagramAccountID: null,
            facecbookID: null,
            icon_url: '/medias/pomme.jpg'
        },
        alerts: []
    },

    mutations: {
        set_posts: function(state, posts){
            state.validated_posts = posts
        },

        remove_post: function(state, id){
            state.validated_posts = state.validated_posts.filter(post => post.id != id)
        },

        set_blockedposts: function(state, blockedposts){
            state.blocked_posts = blockedposts
        },
        
        remove_blockedpost(state, id){
            state.blocked_posts = state.blocked_posts.filter(post => post.id != id)
        },

        set_settings: function(state, settings){
            state.settings = settings
        },

        update_settings: function(state, field, value, options){
            if(state.settings['field']){
                console.log('yes the settings in store contain the  key given');
            }else console.log('no the key given is not in the settings store');
        },

        set_token: function(state, token){
            state.token = token
        },

        set_user: function(state, user){
            state.user = user
        },

        push_alert: function(state, alert){
            alert.id = state.alerts.length + 1
            state.alerts.push(alert)
        },

        remove_alert: function(state, id){
            state.alerts = state.alerts.filter(alert => alert.id !== id)
        },

        
    },
})