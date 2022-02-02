<template>
    <div class="d-flex h-100 pt-80 bg-blue2">
        <div class="w-25">
            <span id="Analytics">
                <div class="text-center w-100 fs-3 text-white">Analytics</div>
                <v-card class="w-80 center my-2 h-50 d-flex justify-space-around align-center">
                    <Icon class="w-20" icon="system-uicons:postcard" style="color: #00B31D" height="40"/>
                    <span class="w-10 text-center">{{postNumber}}</span>
                    <span class="w-60 text-center"> Posts</span>
                </v-card>
        
                <v-card class="w-80 center my-2 d-flex h-50 justify-space-around align-center">
                    <Icon class="w-20" icon="octicon:file-media-24" style="color: #00B7FF" height="30"/>
                    <span class="w-10 text-center">{{postNumber}}</span>
                    <span class="w-60 text-center"> Posts avec Medias</span>
                </v-card>

                <v-card class="w-80 center my-2 h-50 d-flex justify-space-around align-center">
                    <Icon class="w-20" icon="system-uicons:postcard" style="color: #F11010" height="40"/>
                    <span class="w-10 text-center">{{postNumber}}</span>
                    <span class="w-60 text-center"> Posts recalées</span>
                </v-card>                

                <ViewsModal />
            </span>
            <span id="Settings" class="my-4">
                <div class="text-center w-100 fs-3 text-white mt-50">Paramètres</div>
                <v-card class="w-80 center my-2 d-flex h-50 justify-space-around align-center">
                    <Icon  class="w-20" icon="fontisto:hashtag"  style="color: #00B7FF" height="25"/>
                    <input type="text" class="w-80 text-center" v-model="hashtag" >
                </v-card>
                <BlockedUser />
                <TemplateDisplay  />
                <AccountSetting />
                

            </span>

            <span class="b-10 absolute">
                <div class="w-80 center my-2 d-flex h-50 justify-space-around align-center">
                    <Icon  class="w-20" icon="fontisto:facebook"  style="color: white" height="25"/>
                    
                </div>
            </span>
        </div>
        <div class="bg-red">
        </div>
    </div>
</template>

<script src='./js/wall_moderation.js' />