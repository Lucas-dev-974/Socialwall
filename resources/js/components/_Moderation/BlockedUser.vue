<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="500">
      <template v-slot:activator="{ on, attrs }">
        <v-card class="w-80 center my-2 h-50 d-flex justify-space-around align-center">
            <Icon  class="w-10 mx-0" icon="codicon:account" style="color: #F11010" height="25"/>
            <!-- <span class="text-3 w-1 text-center">{{BlockedUser.length}}</span> -->
            <span class="w-60 d-flex justify-space-between align-center text-3">
              Bloqués
              <v-btn color="" v-bind="attrs" v-on="on" icon >
                    <Icon icon="fluent:open-folder-20-filled" style="color: #00B31D" height="20"/>
                </v-btn>
            </span>
        </v-card>

      </template>
      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          Privacy Policy
        </v-card-title>

        <v-card-text>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="dialog = false">
            I accept
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script src="./js/BlockedUser.js" />