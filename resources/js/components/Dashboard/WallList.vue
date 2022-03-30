<template>
<div class="w-100">
    <v-btn color="success" class="mb-5" outlined small>Commander un mur</v-btn>
    <v-simple-table dark  elevation="11" fixed-header height="fit-content"  class="mx-auto w-100">
        <template>
            <thead>
            <tr>
                <th>Wall</th>
                <th class="text-center">Vue</th>
                <th class="text-center">action</th>
            </tr>
            </thead>

            <tbody >
            <tr v-for="wall in $store.state.walls" :key="wall.id">
                <td>{{wall.name}}</td>
                <td class="text-center">{{wall.name}}</td>
                <td class="text-center">
                    <v-btn color="success" @click="open_WallModeration(wall.id)" icon>
                        <v-icon>mdi-open-in-new</v-icon>
                    </v-btn>
                </td>
            </tr>
            </tbody>
        </template>
    </v-simple-table>
</div>

</template>

<script src='./js/WallList.js' />