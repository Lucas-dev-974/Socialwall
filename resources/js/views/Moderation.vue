<template>
    <div class="h-100">
        <div class="d-flex h-100 pt bg-blue2">
            <Sidebar v-if="$store.state.responsive !== 'mobile'" @facebook_login="facebook_login" />

            <div class="w-100 mx-auto px-3" v-if="$store.state.facebook_infos">
                <PostValdiation v-if="$store.state.moderation_page == 'validation'" />
                <Views          v-if="$store.state.moderation_page == 'views'"/>
                <Template       v-if="$store.state.moderation_page == 'template'"/>
                <UserManager    v-if="$store.state.moderation_page == 'user-manager'"/>
            </div>
            
            <v-card outlined elevation="10" v-else class="mx-auto my-auto" height="auto" min-width="200" max-width="450">
                <v-card-title class="d-flex w-100 ">
                   <span class="fs-2">Connectez-vous à facebook</span> 
                   <v-divider></v-divider>

                </v-card-title>

                <v-card-text class="fs-6 px-7 d-flex align-center">
                    Pour utilisé les services de recherche des postes Intagrame, Facebook sur Socialwall veuillez-vous connectez à facebook
                </v-card-text>

                <v-card-text class=" d-flex align-center justify-end w-100">
                    <v-btn color="#1D3C78"  class="text-white bold " tile  @click="facebook_login" small><v-icon left>mdi-facebook</v-icon> connexion </v-btn>
                </v-card-text>

            </v-card>
        </div>
        
        <v-bottom-navigation fixed v-model="bottom_navigation" v-if="$store.state.responsive == 'mobile'">
            <v-btn value="posts">
                <span>Postes</span>
                <v-icon color="green">mdi-post</v-icon>
            </v-btn>

            <v-btn value="views">
                <span>Vues</span>  
                <v-icon color="blue">mdi-eye-settings</v-icon>
            </v-btn>

            <v-btn value="template">
                <span>Templates</span> 
                <v-icon color="blue">mdi-view-grid</v-icon>
            </v-btn>

            <v-btn value="nearby">
                <span>Utilisateurs</span> 
                <v-icon color="blue">mdi-account-settings</v-icon>
            </v-btn>
        </v-bottom-navigation>
    </div>

</template>

<script src='./js/Moderation.js'/>