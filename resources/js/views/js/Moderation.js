import Template        from '../../components/_Moderation/Template.vue'
import Views           from '../../components/_Moderation/Views.vue'
import PostValdiation  from '../../components/_Moderation/PostValidation.vue'
import UserManager     from '../../components/_Moderation/UserManager.vue'
import Sidebar         from '../../components/_Moderation/Sidebar-drawer.vue'

import api from '../../services/ApiServices'
import facebook from '../../facebook.js'

export default{
    components: {
        Template, Views, UserManager,
        PostValdiation, Sidebar
    },

    data(){
        return {
            postNumber: 0,
            hashtag: 'Hashtag',
            bottom_navigation: 'recent'
        }
    },

    mounted(){
        this.load_facebook_profile()
    },

    methods: {
        update_wall: function(field, value){
            api.patch('/api/wall', {
                field: field, wallid: this.$store.state.wall.id, value: value
            }).then(({data}) => {
                this.$store.commit('update_wall', { field: field, value: value })
                this.$store.commit('push_alert', {
                    type: 'success', message: data
                })
            }).catch(error => { console.log(error);}) 
        },
        
        facebook_login: function(){
            FB.login()
            FB.Event.subscribe('auth.statusChange', (response) => {
                console.log(response);
                if(response.status == 'connected'){
                    api.post('/api/settings', {
                        name: 'facebook_token_infos',
                        type: 'facebook',
                        value: JSON.stringify({
                            token:    response.authResponse.accessToken,
                            expireIn: response.authResponse.expiresIn,
                            userID:   response.authResponse.userID
                        })
                    }).then(({data}) => {
                        console.log(data)
                    }).catch(error => {
                        console.log(error)
                    })

                }
            });
        },

        load_facebook_profile: function(){
            api.get('/api/facebook/profile').then(({data}) => {
                console.log(data)
            }).catch(error => {
                if(error.response.status == 401){
                    this.facebook_connected = false
                    facebook.handleFacebookSdk()
                }
            })
        }
    }
}