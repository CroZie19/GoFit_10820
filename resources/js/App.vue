<template>
    <SnackBar />
    <v-app class="grey lighten-4">
        <router-view></router-view>
    </v-app>
</template>

<script>
import SnackBar from "./components/SnackBar.vue";

export default {
    components: {
        SnackBar,
    },
};
</script>
