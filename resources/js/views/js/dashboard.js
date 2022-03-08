import UsersList from '../../components/UsersList.vue'
import WallList  from '../../components/WallList.vue'

import api from '../../services/ApiServices.js'
import facebook from '../../facebook.js'

export default{
    components: {
        UsersList, WallList
    },
    data(){
        return {
            email:    this.$store.state.user.email,
            name:     this.$store.state.user.name,
            lastname: this.$store.state.user.lastname,
            phone:    this.$store.state.user.phone,
            image_src: this.$store.state.user.medias_url ?? '/medias/default-user/account.png',

            wallname: '',
            hashtag: '',
            views:  0,

            facebook_connected: false,
        }
    },

    mounted(){
        this.$store.commit('check_login', null) // Check if user app token is valid
        this.load_Settings()                    // Load user Facebook setting
        
        this.load_facebook()

        this.load_walls()
        
        if(this.$store.state.user.role_id == 1){
            this.load_wall()
        }
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
            api.get('/api/wall')
            .then(({data}) => {
                this.$store.commit('set_walls', data)
            }).catch(error => {
                console.log(error);
            })
        },

        load_wall: function(){
            let wallid
            api.get('/api/admin/wall_demo').then(({data}) => { // To get the wall demonstration id
                console.log(data);
                if(data != null){
                    data = JSON.parse(data)
                    wallid = data.wall_demo
                }
            }).catch(error => {  wallid = null })

            if(wallid != null){ // To get the wall demonstration datas if wall demonstration was defined in database for the user
                api.get('/api/wall/' + wallid).then(({data}) => { 
                    console.log('laod wall data second step: ', data);
                    this.$store.commit('set_wall', data.wall)
                    this.wallname = data.wall.name
                    this.hashtag  = data.wall.hashtag
                }).catch(error => console.log(error))
            }
        },

        open_wall: function(wallid){
            api.get('/api/wall/' + wallid)
            .then(({data}) => {
                console.log('open wall its data is loaded: ', data);
                this.$store.commit('set_wall', data.wall)
                this.$router.push('moderation')
            }).catch(error => console.log(error))
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
                console.log(data);
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

        load_facebook: function(){
            api.get('/api/facebook/getpages').then(({data}) => {
                console.log(data)
            }).catch(error => {
                if(error.response.status == 401){
                    this.$store.commit('push_alert', {
                        message: 'Vous avez été déconnecter de facebook en raison d\'une longue absence',
                        type: 'warning'
                    })
                    this.facebook_connected = false
                    this.load_facebook()
                }
                console.log(error.response.status)
            })
        }
    }
}