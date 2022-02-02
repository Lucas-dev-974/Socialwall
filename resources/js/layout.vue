<template>
    <div>
        <v-app style="position: relativ; ">
            <Navbar />
            <Alert />
            <router-view>
                
            </router-view>
        </v-app>
    </div>

</template>

<script>
import Navbar from './components/Navbar.vue'
import Alert from './services/Alert.vue'
export default{
    components:{
        Navbar, Alert
    }
}

</script>
