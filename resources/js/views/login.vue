<template>
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
                <v-card class="elevation-12">
                    <v-toolbar dark color="primary">
                    <v-toolbar-title>Login form</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                    <v-form>
                        <v-text-field v-model="email" prepend-icon="mdi-account" name="email" label="Email" type="text"></v-text-field>
                        <v-text-field v-model="password" id="password" prepend-icon="mdi-lock" name="password" label="Password" type="password"></v-text-field>
                    </v-form>
                    </v-card-text>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" @click="login">Login</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>


<script src="./js/login.js" />