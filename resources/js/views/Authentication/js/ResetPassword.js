import api from '../../../services/ApiServices.js'

export default{
    data(){
        return{
            token: "",
            email: "",
            password: "",
            password_confirmation: ""
        }
    },

    mounted(){
        const urlParams = new URLSearchParams(window.location.search);
        this.email = urlParams.get('email')
        this.token = this.$route.params.token
    },

    methods: {
        ResetPassword: function(){
            console.log(this.email);
            api.post('/api/auth/reset-password', {
                token: this.$route.params,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            }).then(({data}) => {
                console.log(data)
            }).catch(error => console.log(error))
        }
    }
}