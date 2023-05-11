<template>
    <v-navigation-drawer
        class="bg-blue-darken-4"
        v-model="drawer"
        v-bind:app="drawer"
        persistent
    >
        <v-list>
            <v-list-item
                prepend-avatar="https://www.pngitem.com/pimgs/m/421-4212341_default-avatar-svg-hd-png-download.png"
                :title="user.role"
                :subtitle="user.jabatan_pegawai"
            ></v-list-item>
        </v-list>
        <v-divider></v-divider>
        <v-list density="compact" nav>
            <v-list-item
                value="Beranda"
                title="Beranda"
                prepend-icon="mdi:mdi-view-dashboard"
                :to="{ name: 'Home' }"
            ></v-list-item>
            <v-list-group v-for="menu in menus" :value="menu.judul">
                <template v-slot:activator="{ props }">
                    <v-list-item
                        v-bind="props"
                        :value="menu.judul"
                        :title="menu.judul"
                        :prepend-icon="menu.ikon"
                    ></v-list-item>
                </template>

                <v-list-item
                    v-for="submenu in menu.submenu"
                    :value="submenu.judul"
                    :title="submenu.judul"
                    :prepend-icon="submenu.ikon"
                    :to="submenu.url"
                ></v-list-item>
            </v-list-group>
        </v-list>
        <template v-slot:append>
            <div class="pa-2">
                <v-btn block color="blue-darken-3" @click="logOut">
                    Logout
                </v-btn>
            </div>
        </template>
    </v-navigation-drawer>

    <v-app-bar color="grey-lighten-3" v-bind:app="drawer" dark flat fixed>
        <v-app-bar-nav-icon
            color="grey"
            icon="mdi:mdi-menu"
            @click="drawer = !drawer"
        ></v-app-bar-nav-icon>
    </v-app-bar>

    <v-main v-bind:padding-left="drawer ? 256 : 0" class="bg-grey-lighten-3">
        <v-container fluid>
            <router-view></router-view>
        </v-container>
    </v-main>
</template>

<script>
import UserService from "../services/user.service";

export default {
    name: "Dashboard",
    data() {
        return {
            drawer: true,
            menus: {},
            user: {},
        };
    },
    mounted() {
        UserService.getUserData().then((response) => {
            if (response.data.success) {
                this.user = response.data.user;
            }
        });
        UserService.getMenu().then((response) => {
            if (response.data.success) {
                this.menus = response.data.menu;
            }
        });
    },
    methods: {
        logOut() {
            this.loading = true;
            this.$store.dispatch("auth/logout").then(
                (response) => {
                    if (response.data.success) {
                        this.$router.push("/login");
                    }
                },
                (error) => {
                    this.loading = false;
                }
            );
        },
    },
};
</script>

<style lang="scss" scoped></style>
