<template>
    <v-app-bar elevation="4" ref="appbar" app color="transparent" style="backdrop-filter: blur(2px)">
        <div class="d-flex justify-space-around w-100">
            <div class="w-100 text-center text-white" v-if="!is_dashboard">
                {{hashtag}}
            </div>

            <div class="w-100">
                <div v-if="is_dashboard" class="w-100 text-center">
                    {{Title}}
                </div>

                <span v-else class="w-100 d-flex justify-center">
                    <a href=""><v-icon color="white">mdi-facebook</v-icon></a>
                    <a href=""><v-icon color="white">mdi-instagram</v-icon></a>
                </span>
            </div>

            <div class="w-100 text-center text-white" v-if="!is_dashboard">
                {{Title}}
            </div>
        </div>
    </v-app-bar>
</template>

<script src="./js/Navbar.js" />