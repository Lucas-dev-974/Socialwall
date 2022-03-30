export default{

    data(){
        return {
            user_media: this.$store.state.user.medias_url ?? '/medias/default-user/account.png'
        }
    },

    mounted(){
    },

    methods: {

    }
}