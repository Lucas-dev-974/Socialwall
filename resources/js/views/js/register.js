import axios from 'axios'
import api from '../../services/ApiServices'


export default{
    data(){
        return {
            lastname: '',
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
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
                this.$store.commit('set_token', data.token)
                this.$router.push('/dashboard')
            }).catch(error => {
                console.log(error);
            })
        }
    }
}