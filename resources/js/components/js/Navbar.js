export default{
    data(){
        return {
            Title: 'Nautilus',
            is_dashboard: null,
            hashtag: '',
            app: app,
            color: 'transparent'
        }
    },

    mounted(){
        if(this.$route.name == "home"){
            this.is_dashboard = false
            this.Title = 'Nautilus'
        
        }else{
            this.is_dashboard = true
            this.Title = 'Wall Dashboard'
            this.$refs['appbar'].$el.classList.remove('v-app-bar--fixed')
            this.color = "#1281AD"
        }
    },
}