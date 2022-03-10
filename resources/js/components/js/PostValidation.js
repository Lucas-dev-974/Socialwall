const JsonPost = [
    {
        id: 1234,
        
    }
]

export default{
    data(){
        return {
            post_to_validate: [],
        }
    },

    mounted(){
        console.log(this.$store.state.wall);
    }
}