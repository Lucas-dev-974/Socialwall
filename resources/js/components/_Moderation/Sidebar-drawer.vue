<template>
<div class="h-100" style="heigth: 100% !important">
    <v-card tile style="heigth: 100% !important" class="bg-red h-100">
      <v-navigation-drawer permanent expand-on-hover  style="heigth: 100% !important">
        <v-list>
          <v-list-item class="px-2">
            <v-list-item-avatar>
              <v-img :src="user_media"></v-img>
            </v-list-item-avatar>
          </v-list-item>

          <v-list-item link>
            <v-list-item-content>
              <v-list-item-title class="text-h6">
                {{$store.state.user.lastname}} {{$store.state.user.lastname}}
              </v-list-item-title>
              <v-list-item-subtitle>{{$store.state.user.email}}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-divider></v-divider>

        <v-list nav dense >
          <v-list-item-title><h4>Analitique</h4></v-list-item-title>
          <v-list-item link @click="$store.commit('set_moderationpage', 'validation')">
            <v-list-item-icon>
              <v-icon color="green">mdi-post</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Postes</v-list-item-title>
          </v-list-item>
          <v-list-item link @click="$store.commit('set_moderationpage', 'views')">
            <v-list-item-icon>
              <v-icon color="blue">mdi-eye-settings</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Vues/jours</v-list-item-title>
          </v-list-item>
          <v-list-item link @click="$store.commit('set_moderationpage', 'template')">
            <v-list-item-icon>
              <v-icon color="blue">mdi-view-grid</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Template</v-list-item-title>
          </v-list-item>
          <v-list-item link @click="$store.commit('set_moderationpage', 'user-manager')">
            <v-list-item-icon>
              <v-icon color="blue">mdi-account-settings</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Utilisateurs</v-list-item-title>
          </v-list-item>

          <v-list-item link class="list-item-facebook mx-0 px-0" >
            
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
    </v-card>
  </div>
</template>
<script src="./js/Sidebar-drawer.js" />