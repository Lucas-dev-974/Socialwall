<template>
    <v-card id="image-viewer" style="width: fit-content" v-click-outside="onClickOutside">
        <v-img contain :src="$store.state.image_viewer.image_src" class="mx-auto"></v-img>
    </v-card>
</template>

<script>

export default {
    methods: {
        onClickOutside: function(){
            this.$store.commit('close_ImageViewer')
        }
    }
}
</script>
