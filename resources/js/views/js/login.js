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
        login: async function(){
            let credentials = {
                email: this.email,
                password: this.password
            }

            let url = window.location.origin+"/api/auth/"
            console.log('url:', url);
            axios.post(url, credentials)
            .then(data => {
                console.log(data);
            }).catch(error => {
                console.log(error);
            })
            // let response = await ApiService.post('https://social-walll.herokuapp.com/api/auth/', credentials)
            // if(response.status == 200){
            //     console.log();
            //     this.$store.commit('set_token', data.access_token)
            //     this.$router.push('wall-moderation')
            // }

        }
    }   
}