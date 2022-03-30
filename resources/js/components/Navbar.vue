<template>
    <v-app-bar elevation="4" id="appar" max-height="60px" ref="appbar" :color="color" >
        <div class="w-100 d-flex align-center">
            <div class="left d-flex align-center">
                <span class="fs-3 text-white mr-5 link-custom-hover-yellow">{{Title}}</span>
                <div class="menu">
                    <!-- <a href="#" @click="open_page('moderation')" class="text-white text-3 mx-2">moderation</a> -->
                    <a href="#" class="text-white text-3 mx-2">wall</a>
                </div>
            </div>

            <div class="center">

            </div>

            <div class="rigth">
                <div class="h-100 d-flex" v-if="$route.name !== 'login'" id="logout">
                    <v-btn color="#e5374e"  elevation="10" class="text-white text-3" small @click="logout" >Déconnexion</v-btn>
                </div>
            </div>
        </div>
    </v-app-bar>
</template>

<script src="./js/Navbar.js" />