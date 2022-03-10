<template>
  <v-dialog v-model="dialog" width="900">
    <template v-slot:activator="{ on, attrs }">

      <v-card class="w-80 center my-2 h-50 d-flex justify-space-around align-center">
          <Icon class="w-20" icon="eva:eye-fill" style="color: #00B31D;" width="23"/>
          <span class="w-10 text-3">{{viewsNumber}}</span>
          
          <span class="w-60 text-3 d-flex justify-space-between align-center">
            Vue/Jour
              <v-btn color="" v-bind="attrs" v-on="on" icon >
                  <Icon icon="fluent:open-folder-20-filled" style="color: #00B31D" height="20"/>
              </v-btn>
          </span>
      </v-card>

    </template>
    <v-card>
      <v-card-title> Vues/Jours </v-card-title>
      <ViewsChart />
    </v-card>
  </v-dialog>
</template>


<script src="./js/ViewsModal.js" />