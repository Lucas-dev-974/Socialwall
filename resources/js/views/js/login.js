import ApiService from '../../services/ApiServices'
import axios from 'axios'
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

            axios.post('http://social-walll.herokuapp.com/api/auth/',  credentials)
            .then(({data}) => {
                console.log(data);
                this.$store.commit('set_token', data.access_token)
                this.$router.push('wall-moderation')
            }).catch(err => {
                console.log(err);
                // console.log(err.response.status);
            }) 
        }
    }   
}