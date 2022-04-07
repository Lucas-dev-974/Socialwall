import axios from "axios"

export default{
    data(){
        return {
            email: '',
            password: ''
        }
    }, 

    methods: {
        login: function(){
            let credentials = {
                email:    this.email,
                password: this.password
            }

            axios.post('/api/auth',  credentials)
                .then(({data}) => {
                    this.$store.commit('set_token', data.token)
                    this.$store.commit('set_user',  data.user)
                    this.$router.push('moderation')
                }).catch(error => {
                    this.$store.commit('push_alert', { type: 'warning', message: error.response.data.error })
                }) 
        }
    }   
}