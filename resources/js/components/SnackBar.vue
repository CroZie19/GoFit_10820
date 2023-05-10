<template>
    <v-snackbar
        v-model="snackbar.snackbar.active"
        :color="snackbar.snackbar.color"
        :right="true"
        :bottom="true"
        :timeout="snackbar.snackbar.timer"
    >
        {{ snackbar.snackbar.message }}
        <template v-slot:actions>
            <v-btn
                color="white"
                variant="text"
                @click="snackbar.snackbar.active = false"
            >
                Close
            </v-btn>
        </template>
    </v-snackbar>
</template>

<script>
import { mapState } from "vuex";

export default {
    name: "SnackBar",
    computed: {
        ...mapState(["snackbar"]),
    },
};
</script>

<style lang="scss" scoped></style>
