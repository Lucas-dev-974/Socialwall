import Axios from 'axios'

let token = null
if(window.localStorage.getItem('vuex')){
    token = JSON.parse(window.localStorage.getItem('vuex')).token
}

Axios.defaults.headers.common = {'Authorization': `bearer ${token}`}
let axios = Axios.create({
    url: "https://cm-wall.herokuapp.com"
})
export default axios