import Axios from 'axios'

let token = null
if(window.localStorage.getItem('vuex')){
    token = JSON.parse(window.localStorage.getItem('vuex')).token
}

Axios.defaults.headers.common = {'Authorization': `bearer ${token}`}
const axios = Axios.create()

export default axios