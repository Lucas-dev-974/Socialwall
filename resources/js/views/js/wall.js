import axios from "axios"

export default{
    data(){

    },

    mounted(){

        if(this.$store.state.views)
        axios.get('/api/facebook/')
        .then(({data}) => {
            
        })
    }
} 