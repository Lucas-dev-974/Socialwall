<template>
    <v-card class="mx-auto text-center  w-100"  width="1100px" height="480px" >
        <v-card-text>
        <v-sheet color="rgba(0, 0, 0, .12)">
            <v-sparkline
            :value="value"
            color="rgba(255, 255, 255, .7)"
            height="100"
            padding="24"
            stroke-linecap="round"
            smooth
            >
            <!-- <template v-slot:label="item">
                ${{ item.value }}
            </template> -->
            </v-sparkline>
        </v-sheet>
        </v-card-text>
    </v-card>
</template>

<script src="./js/ViewsChart.js" />