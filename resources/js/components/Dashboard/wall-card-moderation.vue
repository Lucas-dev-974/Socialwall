<template>
    <v-card class="mx-auto mt-5 custom-card" elevation="8" v-if="$store.state.user.role_id == 1">
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
</template>

<script src="./js/wall-card-moderation.js" />