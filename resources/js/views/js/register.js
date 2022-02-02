import axios from 'axios'
import api from '../../services/ApiServices'


export default{
    data(){
        return {
            name: '',
            lastname: '',
            email: '',
            password: '',
            password_confirmation: '',

            create_wall: false,
            token: null
        }
    },

    methods: {
        register: function(){
            api.patch('/api/auth/', {
                name: this.name,
                lastname: this.lastname,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                create_wall: this.create_wall

            }).then(({data}) => {
                this.$store.commit('set_user', data.user)
            }).catch(error => {
                console.log(error);
            })

            api.post('/api/auth/', {
                email: this.email,
                password: this.password
            }).then(({data}) => {
                console.log(data);
                this.$store.commit('set_token', data.access_token)
                this.$router.push('wall-moderation')
            }).catch(error => {
                console.log(error);
            })
        }
    }
}