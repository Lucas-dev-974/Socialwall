import axios from "axios"

export default{
    data(){

    },

    mounted(){
        axios.get('https://dev-development.xyz/api/facebook/')
        .then(({data}) => {
            
        })
    }
} 