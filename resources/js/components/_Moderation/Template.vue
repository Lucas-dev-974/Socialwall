<template>
  <v-card class="pa-3 my-5">
    <v-card-title class="d-flex">
      <v-icon color="blue">mdi-view-grid</v-icon>  Templates
    </v-card-title>
    <v-divider></v-divider>

    <div class="d-flex flex-wrap container">
      <div class="w-100" style="min-width: 400px">
        
        <div class="fs-4 mb-6"> Paramètres d'affichage </div> 
        

        <div class="d-flex flex-wrap">
          <div class="w-50 px-10">
            <v-text-field label="Nombre de post" outlined dense type="number"></v-text-field>
          </div>

          <div class="w-50 px-10">
            <v-text-field label="Temps de rafrachisement" outlined dense type="number"></v-text-field>
          </div>

          <div class="w-50 px-10">
            <label for="">Couleur de fond</label>
            <v-color-picker v-model="bg_color" dot-size="8" hide-mode-switch hide-canvas mode="hexa" swatches-max-height="50"></v-color-picker>
          </div>

          <div class="w-50 px-10">
              <v-file-input dense v-model="files" color="deep-purple accent-4"  label="Choisir une image" multiple  prepend-icon="mdi-paperclip" outlined>
                <template v-slot:selection="{ index, text }">
                  <v-chip v-if="index < 2" color="deep-purple accent-4" dark label small>
                    {{ text }}
                  </v-chip>

                  <span v-else-if="index === 2" class="text-overline grey--text text--darken-3 mx-2" >
                    +{{ files.length - 2 }} File(s)
                  </span>
                </template>
              </v-file-input>
          </div>          
        </div>
      </div>
      
      <div class="w-100">
        <v-divider></v-divider>
        <div class="fs-4 mb-5"> Style d'affichage</div> 
        <div class="container d-flex flex-wrap">
          <v-card class="mx-3 pa-" min-width="300px" max-width="380px">
            <v-card-title>
              Affichage en grille
            </v-card-title>
            <v-checkbox  style="position: absolute; right: 10px; top: 0px"></v-checkbox>
            
          </v-card>  
          <v-card class="mx-3 pa-4" min-width="170px" max-width="380px">
            <v-checkbox  style="position: absolute; right: 10px"></v-checkbox>
            Affichage en masonry
          </v-card>  
        </div>  
      </div>
    </div>
  </v-card>
</template>


<script src="./js/Template.js" />