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
                    console.log('login');
                    console.log(data);
                    this.$store.commit('set_token', data.token)
                    this.$store.commit('set_user', data.user)

                    if(data.user.role_id == 1) this.$router.push('dashboard')
                    else                       this.$router.push('moderation')
                }).catch(error => {
                    this.$store.commit('push_alert', {
                        type: 'warning',
                        message: error.response.data.error
                    })
                }) 
        }
    }   
}