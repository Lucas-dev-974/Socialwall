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
        console.log(this.$route.name);
        switch(this.$route.name){
            case 'homme':
                this.is_dashboard = false
                this.Title = 'Nautilus'
                break

            case 'login': 
                this.is_dashboard = true
                this.Title = 'Social-wall Connexion'
                this.$refs['appbar'].$el.classList.remove('v-app-bar--fixed')
                this.color = "#1281AD"
                break

            case 'wall':
                this.is_dashboard = true
                this.Title = 'Social-wall Moderation'
                this.$refs['appbar'].$el.classList.remove('v-app-bar--fixed')
                this.color = "#1281AD"
                break
            
        }
    },
}