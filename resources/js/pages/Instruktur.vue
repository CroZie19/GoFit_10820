 <template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent width="800">
            <v-card>
                <v-card-title class="text-center">
                    tess
                    <span class="text-h5 text-center">{{ dialogTitle }}</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-form ref="form">
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                        label="Nama*"
                                        v-model="form.nama_instruktur"
                                        :error-messages="errors.nama_instruktur"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-text-field
                                        label="Email*"
                                        v-model="form.username_instruktur"
                                        :error-messages="errors.username_instruktur"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-text-field
                                        label="Nomor Telepon*"
                                        v-model="form.noTelp_instruktur"
                                        :error-messages="errors.noTelp_instruktur"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                        label="Password"
                                        v-model="form.password_instruktur"
                                        :append-inner-icon="
                                            showPassword
                                                ? 'mdi:mdi-eye'
                                                : 'mdi:mdi-eye-off'
                                        "
                                        :type="
                                            showPassword ? 'text' : 'password'
                                        "
                                        :error-messages="errors.password_instruktur"
                                        @click:append-inner="
                                            showPassword = !showPassword
                                        "
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                        label="Alamat*"
                                        v-model="form.alamat_instruktur"
                                        :error-messages="errors.alamat_instruktur"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    tessssssssssss
                                         <input v-model="form.tanggal_lahir_instruktur" :error-messages="errors.tanggal_lahir_instruktur" type="date"/>
                                     </v-col>
                            </v-row>
                        </v-form>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue-darken-1"
                        variant="text"
                        @click="dialog = false"
                    >
                        Batal
                    </v-btn>
                    <v-btn
                        color="blue-darken-1"
                        variant="text"
                        @click="submitForm"
                    >
                        Simpan
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>

    <v-container>
        <v-row>
            <v-col cols="12" md="8" align-self="center">
                <v-btn
                    prepend-icon="mdi:mdi-plus"
                    color="success"
                    @click="showDialog('Add', null)"
                >
                    Tambah Instruktur
                </v-btn>
            </v-col>

            <v-col cols="30" md="7" align-self="center">
                <v-text-field
                    density="compact"
                    hide-details
                    v-model="search"
                    label="Cari Data"
                    variant="outlined"
                    append-inner-icon="mdi:mdi-magnify"
                ></v-text-field>
            </v-col>
        </v-row>
    </v-container>
    <v-container>
        <v-data-table
            :headers="headers"
            :items="instrukturs"
            :search="search"
            item-value="name"
            class="elevation-1"
            @update:options="getInstrukturList"
            @update:instrukturs="getInstrukturList"
        >
            <template v-slot:item="{ item }">
                <tr>
                    <td>{{ item.columns.nama_instruktur }}</td>
                    <td>{{ item.columns.username_instruktur }}</td>
                    <td>{{ item.columns.alamat_instruktur }}</td>
                    <td>{{ item.columns.noTelp_instruktur }}</td>
                    <td>
                        <v-menu>
                            <template v-slot:activator="{ props }">
                                <v-btn
                                    density="compact"
                                    size="small"
                                    icon="mdi:mdi-dots-vertical"
                                    flat
                                    v-bind="props"
                                ></v-btn>
                            </template>

                            <v-list density="compact">
                                <v-list-item
                                    @click="showDialog('Edit', item.columns.id)"
                                >
                                    <v-list-item-title>
                                        Edit
                                    </v-list-item-title>
                                </v-list-item>
                                <v-list-item
                                    @click="deleteInstruktur(item.columns.id)"
                                >
                                    <v-list-item-title>
                                        Hapus
                                    </v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </td>
                </tr>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
import UserService from "../services/user.service";

export default {
    name: "Instruktur",
    data() {
        return {
            dialogTitle: "",
            dialog: false,
            search: "",
            loading: true,
            headers: [
                {
                    align: "start",
                    key: "nama_instruktur",
                    sortable: false,
                    title: "Nama",
                },
                { key: "username_instruktur", title: "Email" },
                { key: "alamat_instruktur", title: "Alamat" },
                { key: "noTelp_instruktur", title: "Telp" },
                { key: "id", title: "" },
            ],
            showPassword: false,
            errors: {},
            instrukturs: [],
            form: {},
        };
    },
    methods: {
        showDialog(type, id) {
            if (type == "Add") {
                this.dialogTitle = "Tambah Instruktur";
                this.form = {};
            } else if (type == "Edit") {
                this.dialogTitle = "Edit Instruktur";
                UserService.getInstruktur(id).then((response) => {
                    if (response.data.success) {
                        this.form = response.data.data;
                    }
                });
            }
            this.dialog = true;
            this.errors = {};
        },
        submitForm() {
            this.errors = {};
            if (this.form.id) {
                UserService.editInstruktur(this.form).then(
                    (response) => {
                        this.$store.dispatch("snackbar/showSnack", {
                            message: response.data.message,
                            color: response.data.success ? "success" : "error",
                        });
                        this.dialog = false;
                    },
                    (error) => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data;
                        } else {
                            this.$store.dispatch("snackbar/showSnack", {
                                message: error.message,
                                color: "error",
                            });
                        }
                        this.dialog = true;
                    }
                );
            } else {
                UserService.addInstruktur(this.form).then(
                    (response) => {
                        this.$store.dispatch("snackbar/showSnack", {
                            message: response.data.message,
                            color: response.data.success ? "success" : "error",
                        });
                        this.dialog = false;
                    },
                    (error) => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data;
                        } else {
                            this.$store.dispatch("snackbar/showSnack", {
                                message: error.message,
                                color: "error",
                            });
                        }
                        this.dialog = true;
                    }
                );
            }

            if (this.dialog) {
                this.getInstrukturList();
            }
        },
        getInstrukturList() {
            UserService.getInstrukturList().then((response) => {
                if (response.data.success) {
                    this.instrukturs = response.data.data;
                }
            });
        },
        deleteInstruktur(id) {
            UserService.deleteInstruktur(id).then(
                (response) => {
                    this.$store.dispatch("snackbar/showSnack", {
                        message: response.data.message,
                        color: response.data.success ? "success" : "error",
                    });
                    this.getInstrukturList();
                },
                (error) => {
                    this.$store.dispatch("snackbar/showSnack", {
                        message: error.message,
                        color: "error",
                    });
                }
            );
        },
    },
};
</script>

<style lang="scss" scoped></style>
