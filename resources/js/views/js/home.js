import axios from "axios"

export default{
    data(){

    },

    mounted(){
        axios.get('/api/facebook/')
        .then(({data}) => {
            
        })
    }
}