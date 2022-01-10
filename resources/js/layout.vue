<template>
    <div>
        <v-app style="position: relativ; ">
            <Navbar />
            <router-view>
                
            </router-view>
        </v-app>
    </div>

</template>

<script>
import Navbar from './components/Navbar.vue'
export default{
    components:{
        Navbar
    }
}

</script>
