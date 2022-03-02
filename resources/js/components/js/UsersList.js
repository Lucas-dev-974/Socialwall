import api from '../../services/ApiServices.js'

export default{
    data(){
        return {
            selected: [],
            users: [],
            search: ''
        }
    },

    watch: {
        search: function(val){
            if(val && val.length > 1){
                api.post('/api/user/', {query: this.search})
                .then(({data}) => {
                    if(data.users.length > 0){
                        this.$store.commit('set_users', data.users)
                    }
                }).catch(error => {
                    this.$store.commit('Alert', {alert: true, message: error.message, color: 'error'})
                })
            }
        }
    },

    mounted(){
        this.get_users()
    },

    methods: {
        get_users: function(){
            api.get('/api/users')
            .then(({data}) => {
                this.$store.commit('set_users', data.users)
            }).catch(error => console.log(error))
        },

        push_selected: function(user){
            this.selected.push(user)
        },

        update_userWall: function(field, value, wallid){
            api.patch('/api/wall/', {
                field: field, value: value, wallid: wallid
            }).then(({data}) => {
                console.log(data);
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
        }
    }
}