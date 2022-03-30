<template>
    <v-container fluid fill-height>
            <v-card class="elevation-12 mx-auto" width="400px">
                <v-toolbar dark color="primary">
                <v-toolbar-title>Connectez-vous</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                <v-form>
                    <v-text-field v-model="email" prepend-icon="mdi-account" name="email" label="Email" type="text"></v-text-field>
                    <v-text-field v-model="password"  prepend-icon="mdi-lock" name="password" label="Mot de passe" type="password"></v-text-field>
                </v-form>
                </v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="warning" @click="$router.push('register')" outlined>S'enregistrer</v-btn>
                <v-btn color="primary" @click="login" outlined>Se connecter</v-btn>
                </v-card-actions>
            </v-card>
    </v-container>
</template>


<script src="./js/login.js" />