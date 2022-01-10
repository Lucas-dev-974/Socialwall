import Axios from "axios"


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

            Axios.post('/api/auth/',  credentials)
            .then(({data}) => {
                console.log(data);
                this.$store.commit('set_token', data.access_token)
                this.$router.push('admin')
            }).catch(err => {
                console.log(err.response.status);
            }) 
        }
    }   
}