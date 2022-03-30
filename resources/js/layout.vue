<template>
    <div class="div">
        <v-app :style="{ backgroundColor: style.contentBackground  }" >
            <Navbar />
            <Alert />
            <router-view >
                
            </router-view>
            
            <Image_view_service v-if="$store.state.image_viewer.show" />
        </v-app>        
    </div>


</template>

<script>
import api    from './services/ApiServices.js'

import Navbar from './components/Navbar.vue'
import Alert  from './services/Alert.vue'
import Image_view_service from './services/Image-view-service.vue'

export default{
    components:{
        Navbar, Alert, Image_view_service
    },

    data(){
        return {
            style:{
                contentBackground: '#fff',
                navbarBackground: '#002473'
            }
        }
    },

    mounted(){
        // this.$vuetify.theme.dark = true
        if(this.$route.name != 'login' || this.$route.name != 'reset-password'){
            this.is_logged()
        }
       
        if(window.location.pathname.includes('/api/auth/reset-password/')){
            let token = window.location.href.split('/').splice(-1,1)[0]
            this.$router.push('/reset-password/' + token)
        } 
        
        this.handle_ScreenResize()
        let _this = this
        window.addEventListener('resize', function(){
            _this.handle_ScreenResize()
        })
    },

    methods:{
        handle_ScreenResize: function(){
            // Get width of screen
            let w = document.documentElement.clientWidth
            
            if(w < 682){
                this.$store.commit('set_responsive', 'mobile')
            }else if(w < 1083){
                this.$store.commit('set_responsive', 'medium')
                if(this.$route.name == 'dashboard'){
                    document.getElementById('dash_user_card').classList.remove('d-flex')
                    document.getElementById('dash_user_card-itemContent').classList.add('d-flex')
                    document.getElementById('user-card-data').classList.add('w-100')
                }
            }else{
                this.$store.commit('set_responsive', 'large')
                if(this.$route.name == 'dashboard'){
                    document.getElementById('dash_user_card').classList.add('d-flex')
                    document.getElementById('dash_user_card-itemContent').classList.remove('d-flex')
                    document.getElementById('user-card-data').classList.remove('w-100')
                }
            }
        },

        is_logged: function(){
            if(this.$store.state.token !== null){
                console.log('in login check');
                api.get('/api/auth/')
                .catch(error => {
                    console.log('login fails');
                    this.$router.push('login')
                })
            }else{
                this.$router.push('login')
            }
        },
    }
}

</script>
