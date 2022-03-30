import api from '../../../services/ApiServices'


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
        register: async function(){
            let response = await api.patch('/api/auth/', {
                name: this.name,
                lastname: this.lastname,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                create_wall: this.create_wall

            })

            console.log(response.data)
            let token = response.data.token
            api.post('/api/auth/check-email').then(({data}) => {
                console.log(data);
            })
            
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