import AccountSetting from '../../components/AccountSettings.vue'
import BlockedUser from '../../components/BlockedUser.vue'
import TemplateDisplay from '../../components/TemplateDisplay.vue'
import ViewsModal from '../../components/ViewsModal.vue'

import { Icon } from '@iconify/vue2'
import ApiServices from '../../services/ApiServices'
import router from '../../services/router'


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
        window.fbAsyncInit = function() {
            FB.init({
              appId            : '881572569456459',
              autoLogAppEvents : true,
              xfbml            : true,
              version          : 'v12.0'
            });
          };
    },

    methods: {
        is_logged: function(){
            if(this.$store.state.token !== null){
                ApiServices.get('/api/auth/').then(({data}) => {console.log(data);})
                .catch(error => {
                    console.log(error);
                    window.location.href = '/login'
                })
            }else window.location.href = '/login'
        }    
    }
}