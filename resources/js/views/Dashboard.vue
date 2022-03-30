<template>
    <div class="px-15" id="dash-container">
        <div class="d-flex justify-center justify-space-arround mt" id="dash_user_card">
            <div id="Account-profile">
                <v-card  elevation="8" min-width="300" class="custom-card" id="user-card-data">
                    <v-list-item class="d-flex justify-center pa-5">
                         <v-img alt="Icon pour la wall page" :src='image_src' max-width="100"></v-img>
                    </v-list-item>

                    <v-list-item class="pa-3 " id="dash_user_card-itemContent">
                        <!-- User account infos -->
                        <div id="infos-account">
                            <div >
                                <div class="my-2 card-block">
                                    <label for="">Email <v-icon small>mdi-pen</v-icon></label>
                                    <input type="text" class="w-100" v-model="email" disabled  v-on:keyup.enter="update_user('email')">
                                </div>
                                
                                <div class="my-2 card-block">
                                    <label for="">Tel</label>
                                    <input type="text" class="w-100" v-model="phone" placeholder="0693XXXXXX" v-on:keyup.enter="update_user('phone')">
                                </div>
                            </div>

                            <div>
                                <div class="my-2 card-block">
                                    <label for="">Nom</label>
                                    <input type="text" class="w-100" v-model="lastname" v-on:keyup.enter="update_user('lastname')">
                                </div>
                                
                                <div class="my-2 card-block">
                                    <label for="">Prénom</label>
                                    <input type="text" class="w-100" v-model="name" v-on:keyup.enter="update_user('name')">
                                </div>

                                <div class="card-block">
                                    <div class="d-flex w-100 justify-right" v-if="!facebook_connected">
                                        <v-btn color="#1D3C78"  class="pa-4 text-white bold" @click="facebook_login" small>Connexion facebook</v-btn>
                                    </div>

                                    <div class="" v-else>
                                        
                                    </div>
                                     
                                </div>
                            </div>
                        </div>
                    </v-list-item>
                </v-card>
                <WallModerationCard v-if="$store.state.responsive == 'large'"/>
            </div>

            <div id="wall-manager" class="w-100  pl-15">
                <UsersList v-if="$store.state.user.role_id == 1"/>
                <WallList  v-else />
                
                <!-- Wall Demonstration -->
                <WallModerationCard v-if="$store.state.responsive == 'medium'"/>
            </div>
        </div>
    </div>
</template>

<script src='./js/dashboard.js' />