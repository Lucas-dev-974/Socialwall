import Vuex from 'vuex' 
import VuePersist from 'vuex-persist'
import Vue from 'vue'
import { isArray } from 'lodash'

Vue.use(Vuex)

const vuexLocal = new VuePersist({
    storage: window.localStorage
})

export default new Vuex.Store({
    plugins: [vuexLocal.plugin],

    state: {
        // User informations
        user: null,
        token: null,
        facebook: null,

        // Wall Moderation
        moderation_page: 'validation',
        wall: null,
        validated_posts: [],
        blocked_posts: [],
        blocked_users: [],

        // User walls
        walls: [],
        responsive: null,

        // Settings
        alerts: [],

        // Admin settings
        users: [],
        facebook_infos: null,

        views: 0,

        display_view: 'square-grid',

        image_viewer: {
            show: false,
            image_src: null
        }
    },

    mutations: {
        // User informations
        set_token: function(state, token){ state.token = token },

        set_user: function(state, user){ state.user = user },
        update_user: function(state, data){
            let availableFields = Object.keys(state.user)
            if(availableFields.includes(data.field)){
                state.user[data.field] = data.value
            }
        },


        // Wall moderations
        set_moderationpage: function(state, page){ state.moderation_page = page },
        set_posts:   function(state, posts){ state.validated_posts = posts },
        remove_post: function(state, id){ state.validated_posts = state.validated_posts.filter(post => post.id != id) },
        update_post: function(state, post){},
        
        set_blockedposts: function(state, blockedposts){ state.blocked_posts = blockedposts },
        remove_blockedpost: function(state, id){ state.blocked_posts = state.blocked_posts.filter(post => post.id != id) },

        set_wall: function(state, wall){ state.wall = wall },
        update_wall: function(state, data){
            if(Object.keys(state.wall).includes(data.field)){
                state.wall[data.field] = data.value
            }
        },


        // User walls
        set_walls:  function(state, walls){ state.walls = walls },
        push_walls: function(state, wall){ state.walls.push(wall) },
        remove_walls: function(state, wallid){ state.walls = state.walls(wall => wall.id != wallid)},

        // App Settings - alerts ....
        push_alert: function(state, alert){
            console.log(alert);
            state.alerts.push({
                id: state.alerts.length + 1,
                ...alert
            })
        },
        remove_alert: function(state, id){ state.alerts = state.alerts.filter(alert => alert.id !== id) },


        // Admin settings
        set_users: function(state, users){ state.users = users },
        update_users: function(state, user){},
        remove_users: function(state, user){ state.users = state.users.filter(User => User.id != user.id) },

        // Facebook app 
        set_FacebookInfos: function(state, infos){
            if(Array.isArray(infos)){
                infos.forEach(info => {
                    state.facebook_infos[info.name] = info.value                      
                })
            }
        },
        setKey_FacebookInfos: function(state, data){
            if(state.facebook_infos == null) state.facebook_infos = {}
            if(isArray(data.key)){
                data.key.forEach((key, index) => {
                    console.log(index, key);
                })
            }else state.facebook_infos[data.key] = data.value
            
        },




        set_responsive: function(state, data){
            state.responsive = data
        },

        // Dashboard settings
        set_DisplayView: function(state, render){
            state.display_view = render
        },

        set_ImageViewer: function(state, data){
            if(state.image_viewer.show){
                state.image_viewer.image_src = data
            }else{
                state.image_viewer.show = true
                state.image_viewer.image_src = data
            }
        },

        close_ImageViewer: function(state, data){
            state.image_viewer.show = false
        }
         
    },
})