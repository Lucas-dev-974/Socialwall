export default{
    data(){
        return {
            Title: 'Nautilus',
            is_dashboard: null,
            hashtag: 'Pomme',
            app: app,
            color: '#1281AD',
        }
    },

    mounted(){
        switch(this.$route.name){
            case 'home':
                this.is_dashboard = false
                this.Title = 'Nautilus'
                document.getElementById('appbar').classList.remove('v-app-bar--fixed')
                break

            case 'login': 
                this.is_dashboard = true
                this.Title = 'Sociawall'
                break

            case 'register': 
                this.is_dashboard = true
                this.Title = 'Sociawall'
                break

            case 'wall':
                this.is_dashboard = true
                this.Title = ''
                this.$refs['appbar'].$el.classList.remove('v-app-bar--fixed')
                this.hashtag = this.$store.state.wall ? this.$store.state.wall.hashtag : ''
                // this.hashtag = this.$store.state.settings.hashtag

            case 'dashboard':
                this.is_dashboard = true
                this.Title = 'Socialwall'
                this.$refs['appbar'].$el.classList.remove('v-app-bar--fixed')
                break
        }
    },

    methods: {

    }
}