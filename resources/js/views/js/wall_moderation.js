import AccountSetting  from '../../components/AccountSettings.vue'
import BlockedUser     from '../../components/BlockedUser.vue'
import TemplateDisplay from '../../components/TemplateDisplay.vue'
import ViewsModal      from '../../components/ViewsModal.vue'
import PostValdiation from '../../components/PostValidation.vue'

import { Icon } from '@iconify/vue2'
import api from '../../services/ApiServices'

export default{
    components: {
        AccountSetting, BlockedUser, 
        TemplateDisplay, ViewsModal, Icon,
        PostValdiation
    },

    data(){
        return {
            postNumber: 0,
            hashtag: 'Hashtag'
        }
    },

    mounted(){
        // Check if wall was loaded from dashboard and If it belongs to the user
        if(this.$store.state.wall == null || this.$store.state.user.id !== this.$store.state.wall.user_id){
            this.$store.commit('push_alert', {
                type: 'warning',
                message: 'Veuillez choisir un mur'
            })
            this.$router.push('dashboard')
        }

        this.hashtag = this.$store.state.wall.hashtag
        this.is_logged()
    },

    methods: {
        is_logged: function(){
            if(this.$store.state.token !== null){
                api.get('/api/auth/')
                .catch(error => {
                    window.location.href = '/login'
                })
            }else window.location.href = '/login'
        },

        FacebookConnected: function(){
        },

        update_wall: function(field, value){
            api.patch('/api/wall', {
                field: field, wallid: this.$store.state.wall.id, value: value
            }).then(({data}) => {
                this.$store.commit('update_wall', { field: field, value: value })
                this.$store.commit('push_alert', {
                    type: 'success', message: data
                })
            }).catch(error => {
                console.log(error);
            })
        }
    }
}