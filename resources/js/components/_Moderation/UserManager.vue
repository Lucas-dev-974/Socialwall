<template>
    <div class="container-fluid mt-5">
        <UsersList />
        <v-card v-if="$store.state.facebook_infos && $store.state.facebook_infos.connected">
            <v-card-title class="d-flex">
                Moderateurs
            </v-card-title>

            <v-card-text>
                test moedraiter
            </v-card-text>
        </v-card>
    </div>
</template>

<script src="./js/UserManager.js" />