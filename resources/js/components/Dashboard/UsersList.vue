<template>
    <div >
        <div class=" w-100 bg- d-flex">
            <div class="w-90">
                <v-text-field  name="name" id="id" label="Chercher un utilisateur" v-model="search" filled rounded></v-text-field>
            </div>
        </div>

        <v-simple-table fixed-header class="mx-auto">
            <template>
                <thead>
                    <tr class="custom-table-header-1">
                        <th>Utilisateur</th> 
                        <th>Email</th> 
                        <th>Mot de passe</th> 
                        <th>Phone</th> 
                        <th>Wall</th>
                        <th>Action</th>
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
                            <div class="d-flex align-center my-0 py-0">
                                <v-menu  min-width="300px" class="my-0 py-0" :close-on-content-click="false">
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn color="#1281ad" dark v-bind="attrs" v-on="on" x-small outlined class="my-0 mx-auto">
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
</template>

<script src="./js/UsersList.js" />