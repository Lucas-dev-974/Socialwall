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
            phone: this.$store.state.user.phone,
            image_src: this.$store.state.user.medias_url ?? '/medias/default-user/account.png',

            createwallform: false,
            wallname: '',
            hashtag: '',
            views:  0,

            appid: '',
            appsecret: '',
            show_app_secret: false,

            facebook_connected: false,
        }
    },

    mounted(){
        facebook.handleFacebookSdk()

        this.$store.commit('check_login', null)
        this.load_walls()
        
        if(this.$store.state.user.role_id == 1){
            this.getAdminParams()
            // this.load_wall()
        }
    },

    methods: {
        getAdminParams: function(){
            api.get('/api/admin/facebook_app_id|facebook_app_secret')
            .then(({data}) => {
                data = JSON.parse(data);
                this.$store.commit('set_FacebookAppInfos', data)
                this.appid     = this.$store.state.facebook_app_infos.facebook_app_id
                this.appsecret = this.$store.state.facebook_app_infos.facebook_app_secret
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
            let wallid = null
            api.get('/api/admin/wall_demo')
            .then(({data}) => {
                console.log('laod wall data first step: ', data)
                if(data != null){
                    data = JSON.parse(data)
                    wallid = data.wall_demo
                    api.get('/api/wall/' + data.wall_demo).then(({data}) => {
                        console.log('laod wall data second step: ', data);
                        this.$store.commit('set_wall', data.wall)
                        this.wallname = data.wall.name
                        this.hashtag  = data.wall.hashtag
                    }).catch(error => console.log(error))
                }

            }).catch(error => { console.log(error) })


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

        update_FacebookSetting: function(field, value, type){
            api.post('/api/admin/', {
                name: field,
                type: type,
                value: value
            }).then(({data}) => {
                data
            }).catch(error => console.log(error ))
        },

        ShowAppSecret: function(){
            this.show_app_secret = !this.show_app_secret
            if(this.show_app_secret) this.$refs.appInputSecret.type = 'text'
            else this.$refs.appInputSecret.type = 'password'
        },

        facebook_login: function(){
            console.log(JSON.parse(localStorage));
        }
    }
}