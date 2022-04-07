import axios from "axios"

const JsonPost = [
    {
        id: 1234,
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris molestie euismod lectus at tincidunt. Vestibulum et finibus neque, a semper justo. Nulla interdum pulvinar urna in scelerisque. Nullam ultricies lacinia condimentum. Aenean fringilla, turpis et porttitor tincidunt, tortor lorem commodo mauris, vel gravida metus neque sed elit. Cras quis mattis mi. Ut eu augue in purus porta scelerisque sit amet a nisi. Quisque pulvinar purus non eros sollicitudin pulvinar. In vehicula magna ipsum, eu posuere diam dictum id. Nullam in placerat magna, at pretium ipsum. ',
        media_url: "https://images.unsplash.com/photo-1449824913935-59a10b8d2000?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max",
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
    {
        id: 1235,
        text: 'Lorem ipsum',
        media_url: "https://images.unsplash.com/photo-1449824913935-59a10b8d2000?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max",
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
    {
        id: 1236,
        text: 'Lorem ipsum',
        media_url: "https://wallpapersmug.com/download/2932x2932/375383/city-evening-cityscape.jpg",
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
    {
        id: 1237,
        text: 'Lorem ipsum',
        media_url: null,
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
    {
        id: 1238,
        text: 'Lorem ipsum',
        media_url: null,
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
    {
        id: 1239,
        text: 'Lorem ipsum',
        media_url: null,
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
    {
        id: 1234,
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris molestie euismod lectus at tincidunt. Vestibulum et finibus neque, a semper justo. Nulla interdum pulvinar urna in scelerisque. Nullam ultricies lacinia condimentum. Aenean fringilla, turpis et porttitor tincidunt, tortor lorem commodo mauris, vel gravida metus neque sed elit. Cras quis mattis mi. Ut eu augue in purus porta scelerisque sit amet a nisi. Quisque pulvinar purus non eros sollicitudin pulvinar. In vehicula magna ipsum, eu posuere diam dictum id. Nullam in placerat magna, at pretium ipsum. ',
        media_url: "https://image.posterlounge.fr/images/l/1891093.jpg",
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
    {
        id: 1235,
        text: 'Lorem ipsum',
        media_url: "https://images.unsplash.com/photo-1449824913935-59a10b8d2000?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max",
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
    {
        id: 1236,
        text: 'Lorem ipsum',
        media_url: "https://wallpapersmug.com/download/2932x2932/375383/city-evening-cityscape.jpg",
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
    {
        id: 1237,
        text: 'Lorem ipsum',
        media_url: null,
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
    {
        id: 1238,
        text: 'Lorem ipsum',
        media_url: null,
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
    
    {
        id: 1239,
        text: 'Lorem ipsum',
        media_url: null,
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
]

const newJsonPost = [
    {
        id: 1234,
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris molestie euismod lectus at tincidunt. Vestibulum et finibus neque, a semper justo. Nulla interdum pulvinar urna in scelerisque. Nullam ultricies lacinia condimentum. Aenean fringilla, turpis et porttitor tincidunt, tortor lorem commodo mauris, vel gravida metus neque sed elit. Cras quis mattis mi. Ut eu augue in purus porta scelerisque sit amet a nisi. Quisque pulvinar purus non eros sollicitudin pulvinar. In vehicula magna ipsum, eu posuere diam dictum id. Nullam in placerat magna, at pretium ipsum. ',
        media_url: "https://images.unsplash.com/photo-1449824913935-59a10b8d2000?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max",
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
    {
        id: 1235,
        text: 'Lorem ipsum',
        media_url: "https://images.unsplash.com/photo-1449824913935-59a10b8d2000?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max",
        post_link: 'https://frfefrefefr',
        author: 'Author name',
        platform: 'facebook' // facebook | instagram
    },
]

export default{
    data(){
        return {
            items:      [],
            to_replace: [],
            new_items:  []
        }
    },

    mounted(){
        this.items = JsonPost
        let url = window.location.search.replace('?', '')
        let url_params = url.split('&')

        let wall_datas = url_params[0].split('=')
        if(wall_datas[0] == 'id'){
            api.get('/api/wall?wallid=' + wall_datas[1])
            .then(({data}) => {
                console.log(data);
            })
        }
    },

    methods: {
        wall: function(){

        },
        
        append: function(item){
            this.items.push(item)
        },

        replace: function(){

        },

        paginate: function(){
            
        }
    }
} 