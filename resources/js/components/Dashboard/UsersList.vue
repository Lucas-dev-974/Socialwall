<template>
        <v-card class="pa-3 my-5" v-if="$store.state.user.role == 1">
            <v-card-title class="d-flex">
                <v-icon color="blue">mdi-account-settings</v-icon>
                <span class="pt-1">{{total_users}}    Clients</span>
                
            </v-card-title>
            <v-divider></v-divider>

            <div class="container-fluid">
                <!-- <UsersList /> -->
                <div >
                <div class=" w-100 my-4 d-flex align-center">
                    <div class="w-80 d-flex align-bottom">
                        <v-text-field  label="Chercher un utilisateur" v-model="search"  solo hide-details="true"></v-text-field>
                    </div>

                    <div class="d-flex align-center justify-end w-10">
                        <v-btn small @click="get_users(current_page, 'previous')" icon color="">
                            <v-icon color="" >mdi-chevron-left</v-icon>
                        </v-btn>
                        {{ current_page }}
                        <v-btn small @click="get_users(current_page, 'next')" icon color="">
                            <v-icon color="">mdi-chevron-right</v-icon>
                        </v-btn>
                    </div>

                    <span class="mx-10"  style="width: 70px">
                        <v-text-field dense  type="number" solo v-model="search_size" hide-details="true" numeric @keyup.enter="get_users(current_page, 'previous')"></v-text-field>
                    </span>
                </div>

                <v-simple-table fixed-header dense class="mx-auto">
                    <template>
                        <thead>
                            <tr>
                                <th>Utilisateur</th> 
                                <th>Email</th> 
                                <th>Mot de passe</th> 
                                <th>Phone</th> 
                                <th>Wall</th>
                                <th>Bloquer/Supprimer</th>
                            </tr>
                        </thead>

                        <tbody >
                            <tr v-for="user in $store.state.users" :key="user.id" class="user-table-tr">
                                <td >
                                    <div class="d-flex align-center">
                                    {{user.lastname}} {{user.name}}
                                    </div>
                                </td>

                                <td>{{user.email}}</td> 
                                <td><a href="#" class="custom-link bold" @click="reset_password(user.email)">Envoyer un mail</a> </td>
                                <td>{{user.phone}}</td>

                                <td>
                                    <div class="d-flex my-0 py-0">
                                        <v-menu  min-width="300px" class="my-0 py-0" :close-on-content-click="false">
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-btn color="#1281ad" dark v-bind="attrs" v-on="on" x-small outlined class="my-0">
                                                    Walls
                                                </v-btn>
                                            </template>

                                            <v-list class="py-0">
                                                <v-list-item class="bg-dark pa-3">
                                                    <v-list-item-title class="text-white fs-4">Wall modération</v-list-item-title>
                                                </v-list-item>
                                                <div class="user-wall-list"  style="max-height: 350px; overflow-y: auto">
                                                    <v-list-item v-for="(wall, index) in user.walls" :key="index" class="wall-list-item">
                                                        <v-list-item-title class="my-2">
                                                            <div class="block" style="display: grid !important">
                                                                <div class="fs-5 fw-3"> {{ wall.name }} </div>
                                                                <div class="d-flex align-center"> modération <v-switch dense v-model="wall.moderated"></v-switch></div>
                                                            </div>
                                                        </v-list-item-title>
                                                    </v-list-item>
                                                </div>

                                            </v-list>
                                        </v-menu>
                                    </div>
                                </td>

                                <td class="d-flex align-center" v-if="user.role_id !== 1">
                                    <v-checkbox x-small v-model="user.blocked" hint="test" @click="update_user('blocked', (user.blocked == 1) ? 0 : 1, user.id)"></v-checkbox>
                                    <v-btn color="red" x-small icon   title="Supprimer l'utilisateur">
                                        <v-icon>mdi-close</v-icon>
                                    </v-btn>
                                </td>

                                <td v-else>
                                    Admin
                                </td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </div>                
            </div>
        </v-card>
   
</template>

<script src="./js/UsersList.js" />