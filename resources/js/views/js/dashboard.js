import WallModerationCard from '../../components/Dashboard/wall-card-moderation.vue'
import UsersList from '../../components/Dashboard/UsersList.vue'
import WallList  from '../../components/Dashboard/WallList.vue'

import api      from '../../services/ApiServices.js'
import facebook from '../../facebook.js'

export default{
    components: {
        UsersList, WallList, WallModerationCard
    },
    data(){
        return {
            email:     this.$store.state.user.email,
            name:      this.$store.state.user.name,
            lastname:  this.$store.state.user.lastname,
            phone:     this.$store.state.user.phone,
            image_src: this.$store.state.user.medias_url ?? '/medias/default-user/account.png',

            facebook_connected: false,
        }
    },

    mounted(){
        this.load_Settings()                    // Load user Facebook setting
        this.load_facebook_profile()
        this.load_walls()
    },

    methods: {        
        load_Settings: function(){
            api.get('/api/settings').then(({data}) => {
                this.$store.commit('set_FacebookInfos', {
                    ...data.facebook_token_infos
                })
            }).catch(error => {
                console.log(error);
            })
        },
        
        load_walls: function(){
            api.get('/api/wall').then(({data}) => {
                this.$store.commit('set_walls', data)
            }).catch(error => {
                console.log(error);
            })
        },

        delete_wall: function(wallid){
            api.delete('/api/wall/' + wallid)
            .then(() => {

            }).catch(error => console.log(error))
        },

        update_user: function(Field){
            let value
            switch (Field) {
                case 'email':
                    value = this.email
                    this.$store.commit('update_user', {
                        field: 'email',
                        value: this.email
                    })
                    break;
            
                case 'name':
                    value = this.name
                    this.$store.commit('update_user', {
                        field: 'name',
                        value: this.name
                    })
                    break;

                case 'lastname':
                    value = this.lastname
                    this.$store.commit('update_user', {
                        field: 'lastname',
                        value: this.lastname
                    })
                    break;
                default:
                    break;
            }

            api.patch('/api/user/', {
                field: Field,
                value: value
            }).then(({data}) => {
                this.$store.commit('push_alert', {
                    type: 'green', message: data[0]
                })
            })
        },  

        handlePenUpdate: function(ref){
            this.$refs[ref].disabled = false
            this.$refs[ref].focus()
        },

        check_FacebookAuth: function(){ 
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
                    // this.z
                    this.facebook_connected = false
                    facebook.handleFacebookSdk()
                }
                console.log(error.response.status)
            })
        }
    }
}