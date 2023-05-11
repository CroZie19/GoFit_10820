<template>
    <v-card justify="center" align="center" class="p-4">
        <v-card-title>
            <div class=" d-flex justify-content-between">
                <h2 class="pl-2">Categories</h2>
                <v-btn @click="dialog = !dialog" color="primary" dark
                    >New Category</v-btn
                >
            </div>
            <v-spacer></v-spacer>
            <v-text-field
                v-model="search"
                append-icon="search"
                label="Search"
                single-line
                hide-details
            ></v-text-field>
        </v-card-title>
    </v-card>
</template>

<script>
export default {
    name: "Jadwal",
};
</script>

<style lang="scss" scoped></style>
