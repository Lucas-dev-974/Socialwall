<template>
    <v-container id="dash-container">
        <div id="Facebook-manager" class="my-5">
            <v-card height="140px" >
                <v-list-item class="px-10 d-flex" style="height: 100%">

                    <!-- user account icon to show on wall -->
                    <div class="h-100">
                        <v-img alt="Icon pour la wall page" class="mr-5 mt-6" :src='image_src' max-width="50px"></v-img>
                    </div>
                    
                    <!-- User account infos -->
                    <div id="infos-account">
                        <div >
                            <div class="my-2 card-block">
                                <label for="">Email <v-icon small>mdi-pen</v-icon></label>
                                <input type="text" class="w-80" v-model="email" disabled  v-on:keyup.enter="update_user('email')">
                            </div>
                            
                            <div class="my-2 card-block">
                                <label for="">Tel</label>
                                <input type="text" class="w-80" v-model="phone" v-on:keyup.enter="update_user('phone')">
                            </div>
                        </div>

                        <div>
                            <div class="my-2 card-block">
                                <label for="">Nom</label>
                                <input type="text" class="w-80" v-model="lastname" v-on:keyup.enter="update_user('lastname')">
                            </div>
                            
                            <div class="my-2 card-block">
                                <label for="">Prénom</label>
                                <input type="text" class="w-80" v-model="name" v-on:keyup.enter="update_user('name')">
                            </div>
                        </div>
                    </div>

                    <!-- If admin is connected show Facebook credentials -->
                    <div id="facebook-app-infos" v-if="$store.state.user.role_id == 1">
                        
                        <fb:login-button  scope="public_profile,email" onlogin="checkLoginState()" @click="facebook_login"> </fb:login-button>

                        <div>
                            <div class="my-2 card-block">
                                <label for="">App ID <v-icon small @click="handlePenUpdate('appInputID')">mdi-pen</v-icon></label>
                                <input ref="appInputID" placeholder="Entrer l'id de l'app facebook a utilisé" disabled type="text" class="w-100" v-model="appid" v-on:keyup.enter="update_FacebookSetting('facebook_app_id', appid, 'text')">
                            </div>
                            
                            <div class="my-2 card-block">
                                <label for="">App secret 
                                    <v-icon small @click="handlePenUpdate('appInputSecret')">mdi-pen</v-icon> 
                                    <v-icon small color="green" v-if="!show_app_secret" @click="ShowAppSecret">mdi-eye-circle</v-icon>
                                    <v-icon small color="red" v-else @click="ShowAppSecret">mdi-eye-circle</v-icon>
                                </label>
                                <input ref="appInputSecret" placeholder="Entrer la clé secret de l'app facebook a utilisé" disabled type="password" class="w-100" v-model="appsecret" v-on:keyup.enter="update_FacebookSetting('facebook_app_secret', appsecret, 'password')">
                            </div>
                        </div>
                    </div>
                </v-list-item>
            </v-card>
        </div>

        <div id="wall-manager" class="d-flex w-100" style="flex-wrap: wrap;">
            <UsersList v-if="$store.state.user.role_id == 1"/>
            <WallList v-else />
            
            <!-- Wall Demonstration -->
            <v-card class="mx-auto" id="wall-infos" v-if="$store.state.user.role_id == 1">
                <v-card-title primary-title class="d-flex justify-space-between">
                    <p>Wall de démonstration</p> 
                    <v-btn color="success" style='margin-top: -15px' @click="open_wall($store.state.wall.id)" x-small icon>
                        <v-icon>mdi-open-in-new</v-icon>
                    </v-btn>
                </v-card-title> 


                <div class="pa-5" v-if="$store.state.wall != null" style="display: grid;">
                    <div class="form-inputs my-1">
                        <label for="Nom">Nom</label>
                        <input class="custom-input" type="text" v-model="wallname">  
                    </div>
                    <div class="form-inputs my-1">
                        <label for="Nom">Hashtag</label>
                        <input class="custom-input" type="text" v-model="hashtag">  
                    </div>
                    <div class="form-inputs my-1">
                        <label for="Nom">Vues: </label>
                        <p>{{views}}</p>
                    </div>
                </div>


                <div class="w-80 mx-auto pa-2" v-else style="min-width: ">
                    <div color="gray w-80 mx-auto mt-4 pa-5">

                    </div>
                </div>
            </v-card>
        </div>
    </v-container>
</template>

<script src='./js/dashboard.js' />