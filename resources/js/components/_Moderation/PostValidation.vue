<template>
    <div id="post-moderation" class="pt-4">
        <div class="d-flex align-bottom justify-space-between">
            <div class="">
                <v-icon v-if="$store.state.display_view != 'square-grid'" @click="ChangeViewSet('square-grid')"  color="white">mdi-view-grid-outline</v-icon>
                <v-icon v-else color="white" @click="ChangeViewSet('list-details')">mdi-format-list-bulleted-square</v-icon>
            </div>
            
            <div class="w-30 d-flex">
                
                <v-text-field elevation="10" solo dense class="pa-0 ma-0 mx-3" hide-details="true" ></v-text-field>
            </div>

            <span>
                <v-icon color="white" @click="validatePost" class="mr-3">mdi-check-circle</v-icon>
                <v-btn v-if="$store.state.responsive != 'mobile'"  color="white"  small>postes validés</v-btn>
                <v-btn v-else color="white" x-small>postes validés</v-btn>
            </span>

        </div>

        <div class="pt-5">
            <!-- Display post to validate into card -->
            <div class="d-flex" style="flex-wrap: wrap"  v-if="$store.state.display_view == 'square-grid'">
                <div v-for="post in posts" :key="post.id">
                    <v-card hover dark :id="'card-' + post.id" class="mx-2 my-2 pt-0" :width="card_max_width" tile  :style="{
                        backgroundImage: `linear-gradient(rgba(2, 2, 2, 0.5), rgba(51, 51, 51, 0.5)), url('${post.media_url}')`,
                        backgroundPosition: 'center'}">
                        
                        <v-card-title class="d-flex justify-space-between px-1 pt-0 mt-0">
                            <span>{{ post.author }}</span>
                            
                            <v-checkbox v-model="post.isvalidate"></v-checkbox>
                        </v-card-title>

                        <div class="pa-2">
                            {{ post.text }}
                        </div>
                    </v-card>
                </div>
            </div>

            <div class="div" v-else>
                <v-simple-table fixed-header height="550px" color="success">
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th class="text-left">Platform</th>
                                <th class="text-left">Comptes</th>
                                <th>Contenue</th>
                                <th>Média</th>
                                <th>Validé</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="post in posts" :key="post.id" >
                                <td>{{ post.platform }}</td>
                                <td>{{ post.author }}</td>
                                <td class="pa-3" style="max-width: 320px !important;" >{{ post.text}} </td>
                                <td>
                                    <v-img class="list-image-item" width="70" :src="post.media_url" @click="GrowUPImage(post.media_url)"></v-img>
                                </td>
                                <td><v-checkbox v-model="post.isvalidate"></v-checkbox></td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
                <div class="text-center mt-3 d-flex justify-center">
                    <v-pagination v-model="page" :length="15" :total-visible="6"></v-pagination>
                    <span style="width: 80px !important">
                        <v-text-field solo v-model="number_posts" type="number" label="Number" dense></v-text-field>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script src='./js/PostValidation.js' />