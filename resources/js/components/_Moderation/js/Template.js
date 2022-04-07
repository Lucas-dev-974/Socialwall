import api from '../../../services/ApiServices.js'

export default{
    data(){
        return {
            files: null,
            settings: null,

            // Style wall
            bg_color: this.$store.state.wall_style ? this.$store.state.wall_style['wall-bg-color'] : '',
            bg_image: this.$store.state.wall_style ? this.$store.state.wall_style['wall-bg-image'] : null,
        }
    },

    mounted() {
        this.get_Settings()    
    },

    methods: {
        get_Settings: function(){
            api.get('/api/settings?wallid=' + this.$store.state.wall.id)
                .then(({data}) => {
                    console.log(data);
                    let wall_style = this.Array2Object(data, 'name', 'value')
                    this.$store.commit('set_wallStyle', wall_style)
                }).catch(error => console.log(error))
        },

        Array2Object: function(entry_datas, name_field, value_field){
            let out_datas = {}
            entry_datas.forEach(data => { out_datas[data[name_field]] = data[value_field] })
            return out_datas
        }
    }
}