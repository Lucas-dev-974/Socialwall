<template>
    <v-app-bar elevation="4" id="appbar" app  :color="color" style="backdrop-filter: blur(2px)">
        <!-- container  -->
        <div class="d-flex justify-space-around w-100">
            <div class="w-100 text-center text-white" v-if="$route.name == 'wall'">
                {{hashtag}}
            </div>

            <div class="d-flex w-100" v-if="$route.name == 'home'"> 
                <span id="navlogo">
                    <img :src="$store.state.settings.icon_url" width="80"/>
                </span>
                <div id="navlist" class="d-flex w-100">
                    <span class="navlist-items d-flex align-center">
                        <a href="#" class="mx-2">Socialwall</a>
                        <a href="#" class="mx-2">Nautilus</a>
                    </span>
                </div>
            </div>

            <div class="w-100" v-if="$route.name != 'home'">
                <div v-if="$route.name == 'wall-moderation' || $route.name == 'login' || $route.name == 'register'" class="w-100 text-center fs-3 text-white">
                    {{Title}}
                </div>

                <span v-if="$route.name == 'wall'" class="w-100 d-flex justify-center">
                    <a href=""><v-icon color="white">mdi-facebook</v-icon></a>
                    <a href=""><v-icon color="white">mdi-instagram</v-icon></a>
                </span>
            </div>

            <div class="w-100 text-center text-white align-center" v-if="$route.name == 'wall'">
                <img :src="$store.state.settings.icon_url" width="80"/>
                {{Title}}
            </div>

            <div class="d-flex justify-space-around align-center" v-if="$route.name == 'home'">
                <v-btn color="white" small outlined class="mx-2" @click="$router.push('login')" v-if="$store.state.userDatas == null">Se connecter</v-btn>
                <v-btn color="white" small outlined class="mx-2" v-else>Mes murs</v-btn>
            </div>
        </div>
    </v-app-bar>
</template>

<script src="./js/Navbar.js" />