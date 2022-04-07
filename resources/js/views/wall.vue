<template>
    <v-app class="bg-linear-blue">
        <div class="top-100" id="Sidebar">
        </div>

        <div class="container-fluid">
         <masonry :cols="{default: 4, 1000: 3, 700: 2, 400: 1}"
                  :gutter="{default: '5px', 700: '5px'}" >

            <div v-for="(item, index) in items" :key="index" class="my-1">
                <v-card tile>
                    <span style="position: absolute; z-index: 90; left: 90%; top: 5px">
                        <v-icon color="white">mdi-facebook</v-icon>
                    </span>
                    <v-img v-if="item.media_url" :src="item.media_url" gradient="to top right, #02020283, #181818b3" class="pa-3">
                        <p class="text-white fs-4">Author account</p>
                        <div class="caption text-white content-card">
                            <span>{{item.text}}</span> 
                        </div>
                    </v-img>
                    <div v-else class="pa-3">
                        <span class="fs-6">Author name</span>
                        <div class="caption pl-3 content-card">
                            <span>{{item.text}}</span>  
                        </div>
                    </div>
                </v-card>
            </div>
        </masonry>
        </div>
    </v-app>
</template>

<script src="./js/wall.js" />
