import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "../components/Dashboard.vue";

import Login from "../pages/Login.vue";
import Home from "../pages/Home.vue";
import Instruktur from "../pages/Instruktur.vue";
import Member from "../pages/Member.vue";
import Jadwal from "../pages/Jadwal.vue";
import JadwalHarian from "../pages/JadwalHarian.vue";
import Perijinan from "../pages/Perijinan.vue";
import Aktivasi from "../pages/Aktivasi.vue";
import DepositUang from "../pages/DepositUang.vue";
import DepositKelas from "../pages/DepositKelas.vue";
import presensiGym from "../pages/bookingGym.vue";
import presensiKelas from "../pages/presensiKelas.vue";

const routes = [
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "",
        name: "Dashboard",
        component: Dashboard,
        children: [
            {
                path: "/",
                name: "Home",
                component: Home,
            },
            {
                path: "instruktur",
                name: "Instruktur",
                component: Instruktur,
            },
            {
                path: "member",
                name: "Member",
                component: Member,
            },
            {
                path: "jadwal",
                name: "Jadwal",
                component: Jadwal,
            },
            {
                path: "jadwal-harian",
                name: "Jadwal-harian",
                component: JadwalHarian,
            },
            {
                path: "perijinanInstruktur",
                name: "perijinanInstruktur",
                component: Perijinan,
            },
            {
                path: "aktivasiMember",
                name: "Aktivasi",
                component: Aktivasi,
            },
            {
                path: "DepositUang",
                name: "DepositUang",
                component: DepositUang,
            },
            {
                path: "DepositKelas",
                name: "DepositKelas",
                component: DepositKelas,
            },
            {
                path: "bookingGym",
                name: "bookingGym",
                component: presensiGym,
            },
            {
                path: "presensiKelas",
                name: "presensiKelas",
                component: presensiKelas,
            },
        ],
    },
];

const router = new createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const publicPages = ["/login"];
    const authRequired = !publicPages.includes(to.path);
    const loggedIn = localStorage.getItem("user");

    if (authRequired && !loggedIn) {
        next("/login");
    } else {
        next();
    }
});

export default router;
