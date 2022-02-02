<template>
    <v-container fluid fill-height>
            <v-card class="elevation-12 mx-auto" width="400px">
                <v-toolbar dark color="primary">
                <v-toolbar-title>Enregistrez-vous</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                <v-form>
                    <v-text-field v-model="name" prepend-icon="mdi-account" name="name" label="Nom" type="text"></v-text-field>
                    <v-text-field v-model="lastname"  prepend-icon="mdi-lock" name="text" label="Prénom" type="text"></v-text-field>
                    <v-text-field v-model="email"  prepend-icon="mdi-lock" name="email" label="Email" type="email"></v-text-field>
                    <v-text-field v-model="password"  prepend-icon="mdi-lock" name="password" label="Mot de passe" type="password"></v-text-field>
                    <v-text-field v-model="password_confirmation"  prepend-icon="mdi-lock" name="password_cofirmation" label="Confirmé le mot de passe" type="password"></v-text-field>
                </v-form>
                </v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="success" @click="$router.push('login')" outlined>Se connecter</v-btn>
                <v-btn color="primary" @click="register" outlined>S'enrgistrer</v-btn>
                </v-card-actions>
            </v-card>
    </v-container>
</template>


<script src="./js/register.js" />