export default{
    data(){
        return {
            Title: 'Nautilus',
            is_dashboard: null,
            hashtag: '',
            app: app
        }
    },

    mounted(){
        if(this.$route.name == "home"){
            this.is_dashboard = false
            this.Title = 'Nautilus'
           
            
            console.log( this.$refs['appbar']);
            // this.$refs['appbar'].$el.setAttribute('app', '')
        }else{
            this.is_dashboard = true
            this.Title = 'Nautilus SocialWall Dashboard'
        }
    },
}