import api from '../../../services/ApiServices'

export default{
    data(){
        return {
            current_page: 1,
            total_users: 0,

            selected: [],
            users: [],
            search: '',
            search_size: 10
        }
    },

    watch: {
        search: function(val){
            if(val && val.length > 0){
                api.post('/api/user/', {query: this.search})
                .then(({data}) => {
                    console.log(data);
                    if(data.data.length > 0){
                        this.$store.commit('set_users', data.data)
                    }
                }).catch(error => {
                    this.$store.commit('push_alert', {alert: true, message: error.message, color: 'error'})
                })
            }else{
                this.get_users()
            }
        }
    },

    mounted(){
        this.get_users()
    },

    methods: {
        get_users: function(page = 1, state){
            if(state == 'next') page = page + 1
            if(state == 'previous' && page > 1) page = page - 1

            api.get('/api/users' + '?page=' + page + '&size=' + this.search_size)
            .then(({data}) => {
                
                this.total_users = data.total
                this.current_page = page
                this.$store.commit('set_users', data.data)
            }).catch(error => console.log(error))
        },

        push_selected: function(user){
            this.selected.push(user)
        },

        update_userWall: function(field, value, wallid){
            api.patch('/api/wall/', {
                field: field, value: value, wallid: wallid
            }).then(({data}) => {
                // console.log(data);
            }).catch(error => console.log(error))
        },

        update_user: function(field, value, userid){
            value = !value
            api.patch('/api/user/', {
                userid: userid, field: field, value: value
            }).then(() => {
                this.$store.commit('push_alert', {
                type: 'success',
                        message: 'Utilisateur mis à jour'
                })
            }).catch(error => {
                console.log(error);
            })
        },

        reset_password: function(email){
            api.post('/api/auth/forgot-password', {
                email: email
            }).then(({data}) => {
                // console.log(data);
                this.$store.commit('push_alert', {
                    message: 'Mail envoyé à ' + email,
                    type: 'success'
                })
            }).catch(error => {
                console.log(error);
            })
        }
    }
}