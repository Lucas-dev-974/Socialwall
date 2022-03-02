import api from '../../services/ApiServices'

export default{
    data(){
        return {

        }
    },

    methods:{
        open_WallModeration: function(wallid){
            api.get('/api/wall/' + wallid).then(({data}) => {
                this.$store.commit('set_wall', data.wall)
            }).catch(error => {
                console.log(error);
            })
        },

        delete_Wall: function(){
            
        }
    }
}