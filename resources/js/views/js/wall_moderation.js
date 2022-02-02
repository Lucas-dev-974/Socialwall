import AccountSetting from '../../components/AccountSettings.vue'
import BlockedUser from '../../components/BlockedUser.vue'
import TemplateDisplay from '../../components/TemplateDisplay.vue'
import ViewsModal from '../../components/ViewsModal.vue'

import { handleFacebookSdk, checkLoginState } from '../../facebook.js'

import { Icon } from '@iconify/vue2'
import ApiServices from '../../services/ApiServices'

export default{
    components: {
        AccountSetting, BlockedUser, 
        TemplateDisplay, ViewsModal, Icon
    },

    data(){
        return {
            postNumber: 0,
            hashtag: 'Hashtag'
        }
    },

    mounted(){
        this.is_logged()
        // handleFacebookSdk('', '12.0')
    },

    methods: {
        is_logged: function(){
            if(this.$store.state.token !== null){
                ApiServices.get('/api/auth/')
                .catch(error => {
                    window.location.href = '/login'
                })
            }else window.location.href = '/login'
        },

        load_WallDatas: function(){
            // ApiServices.get('/api/wall/' ) 
        }
    }
}