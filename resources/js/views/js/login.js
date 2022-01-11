import ApiService from '../../services/ApiServices'

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
                email: this.email,
                password: this.password
            }

            ApiService.post('/api/auth/',  credentials)
            .then(({data}) => {
                this.$store.commit('set_token', data.access_token)
                this.$router.push('wall-moderation')
            }).catch(err => {
                console.log(err);
                console.log(err.response.status);
            }) 
        }
    }   
}