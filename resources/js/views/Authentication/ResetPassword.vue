<template>
    <v-container fluid fill-height>
        <v-card class="elevation-12 mx-auto" width="400px">
            <v-toolbar dark color="primary">
            <v-toolbar-title>Modifié votre mot de passe</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <v-form>
                    <v-text-field v-model="password" prepend-icon="mdi-lock"     name="email" label="Mot de passe" type="password"></v-text-field>
                    <v-text-field v-model="password_confirmation"  prepend-icon="mdi-lock" name="password" label="Confirmé"  type="password"></v-text-field>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="warning" @click="ResetPassword" outlined>Enregistrer mon nouveau mot de passe</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script src="./js/ResetPassword.js" />