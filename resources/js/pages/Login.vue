<template>
    <div class="logingf">
    <div class="d-flex align-center justify-center" style="height: 100vh">
        <v-card width="400" class="mx-auto pa-4 ma-4">
            <v-card-text>
                <v-form validate-on="submit" @submit.prevent="handleLogin">
                    <h3>LOGIN</h3>
                    <v-text-field
                        label="Email"
                        placeholder="Masukkan email"
                        variant="underlined"
                        v-model="form.email"
                        :error-messages="errors.email"
                        class="mb-2"
                    ></v-text-field>
                    <v-text-field
                        label="Password"
                        placeholder="Masukkan password"
                        variant="underlined"
                        v-model="form.password"
                        :append-inner-icon="
                            showPassword ? 'mdi:mdi-eye' : 'mdi:mdi-eye-off'
                        "
                        :type="showPassword ? 'text' : 'password'"
                        :error-messages="errors.password"
                        @click:append-inner="showPassword = !showPassword"
                        class="mb-4"
                    ></v-text-field>
                    <v-btn
                        type="submit"
                        color="success"
                        size="large"
                        variant="elevated"
                        block
                    >
                        <v-progress-circular
                            v-show="loading"
                            indeterminate
                        ></v-progress-circular>
                        <div v-show="!loading">Sign In</div>
                    </v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </div>
</div>
</template>

<style>
    .logingf
    {
        background-image: url('../components/assets/background.jpeg');
        background-size: cover;
        height: 100vh !important;
        position: relative;
        color: black;
    }
    
</style>

<script>
export default {
    name: "Login",
    data() {
        return {
            form: {
                email: "",
                password: "",
                role: "pegawai",
            },
            showPassword: false,
            loading: false,
            message: "",
            errors: {},
        };
    },
    computed: {
        loggedIn() {
            return this.$store.state.auth.status.loggedIn;
        },
    },
    created() {
        if (this.loggedIn) {
            this.$router.push("/");
        }
    },
    methods: {
        handleLogin() {
            this.loading = true;

            this.$store.dispatch("auth/login", this.form).then(
                (response) => {
                    this.loading = false;
                    this.$store.dispatch("snackbar/showSnack", {
                        message: response.message,
                        color: response.success ? "success" : "error",
                    });
                    this.$router.push("/");
                },
                (error) => {
                    this.loading = false;

                    if (error.response.status === 422) {
                        this.errors = error.response.data;
                    } else {
                        this.$store.dispatch("snackbar/showSnack", {
                            message: error.message,
                            color: error.success ? "success" : "error",
                        });
                    }
                }
            );
        },
    },
};
</script>
