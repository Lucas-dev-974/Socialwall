import api from '../../../services/ApiServices.js'

export default {
    data(){
        return {
            wallname: '',
            hashtag:  '',
            views:  0,
        }
    },

    mounted(){
        if(this.$store.state.user.role_id == 1){ 
            this.load_wall() 
        }
    },

    methods: {
        load_wall: async function(){
            let wallid

            let params = await api.get('/api/admin/demo_wall')
            wallid = params.data.value
        
            if(wallid != null){ // To get the wall demonstration datas if wall demonstration was defined in database for the user
                api.get('/api/wall/' + wallid).then(({data}) => { 
                    this.$store.commit('set_wall', data.wall)
                    this.wallname = data.wall.name
                    this.hashtag  = data.wall.hashtag
                }).catch(error => console.log(error))
            }
        },

        open_wall: function(wallid){
            api.get('/api/wall/' + wallid)
            .then(({data}) => {
                console.log('open wall its data is loaded: ', data);
                this.$store.commit('set_wall', data.wall)
                this.$router.push('moderation')
            }).catch(error => console.log(error))
        },

    }
}