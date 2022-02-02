export default{
    data(){
        return {
            Title: 'Nautilus',
            is_dashboard: null,
            hashtag: 'Pomme',
            app: app,
            color: 'transparent',
        }
    },

    mounted(){
        console.log(this.$route.name);
        switch(this.$route.name){
            case 'home':
                this.is_dashboard = false
                this.Title = 'Nautilus'
                document.getElementById('appbar').classList.remove('v-app-bar--fixed')
                this.color = "#1281AD"
                break

            case 'login': 
                this.is_dashboard = true
                this.Title = '< Sociawall'
                this.color = "#1281AD"
                break

            case 'register': 
                this.is_dashboard = true
                this.Title = 'Sociawall'
                this.color = "#1281AD"
                break

            case 'wall':
                this.is_dashboard = true
                this.Title = ''
                this.$refs['appbar'].$el.classList.Moderationremove('v-app-bar--fixed')
                this.color = "#1281AD"
                
                this.hashtag = this.$store.state.settings.hashtag
                break
        }
    },
}