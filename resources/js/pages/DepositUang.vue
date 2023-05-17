<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent width="800">
            <v-card>
                <v-card-title class="text-center">
                    <span class="text-h5 text-center">{{ dialogTitle }}</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-form ref="form">
                            <v-row>
                                <v-text-field v-model="form.id_kelas" :error-messages="errors.id_kelas"
                                    hidden></v-text-field>
                                <v-text-field v-model="form.id_jadwal_harian"
                                    hidden></v-text-field>
                                <v-text-field v-model="form.tanggal_kelas_harian"
                                    :error-messages="errors.tanggal_kelas_harian" hidden></v-text-field>
                                <v-col cols="12">
                                    <span class="text-primary">Nama Instruktur sebelumnya: {{ form.nama_instruktur }}</span>
                                </v-col>
                                <v-col cols="12">
                                    <span class="text-primary">Tanggal: {{
                                        new Date(
                                            form.tanggal_kelas_harian
                                        ).toLocaleDateString(
                                            "id-ID",
                                            {
                                                day: "numeric",
                                                month: "long",
                                                year: "numeric",
                                            }
                                        )
                                    }}</span>
                                </v-col>
                                <v-col cols="12">
                                    <label for="nama_pengganti" class="block text-sm text-gray-700">Pilih Instruktur
                                        Pengganti<span class="text-red-700">*</span></label>
                                    <select id="nama_pengganti" v-model="form.id_instruktur" name="nama_pengganti"
                                        autocomplete="nama_pengganti"
                                        class="border border-dark w-100 custom-select custom-select-lg">
                                        <option v-for="item in instrukturs" v-bind:key="item.id" :value="item.id">
                                            {{ item.nama_instruktur }}
                                        </option>
                                    </select>
                                </v-col>
                            </v-row>
                        </v-form>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
                        Batal
                    </v-btn>
                    <v-btn color="blue-darken-1" variant="text" @click="submitForm">
                        Simpan
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>

    <v-container>
        <v-row class="mt-4 mx-auto">
            <v-text-field class="pr-4" density="compact" hide-details v-model="search" label="Cari Data" variant="outlined"
                append-inner-icon="mdi:mdi-magnify"></v-text-field>
            <v-btn prepend-icon="mdi:mdi-plus" color="success" @click="showDialog('Add', null)">
                Tambah Perijinan
            </v-btn>

        </v-row>
    </v-container>
    <v-container>
        <v-data-table :headers="headers" :items="perijinan" :search="search" item-value="name"
            class="elevation-1 rounded rounded-lg sha" @update:options="getPerijinanList"
            @update:instrukturs="getPerijinanList">
            <template v-slot:item="{ item }">
                <tr>
                    <td>{{ item.columns.nama_instruktur }}</td>
                    <td>{{ item.columns.jenis_kelas }}</td>
                    
                     <td>
                            <span v-if="item.columns.status_kelas_harian == 'Kelas Bertugas'" class="text-success">{{
                                item.columns.status_kelas_harian }}</span>
                            <span v-else class="text-warning">{{ item.columns.status_kelas_harian }}</span>
                        </td>
                    <td>{{
                        new Date(
                            item.columns.tanggal_kelas_harian
                        ).toLocaleDateString(
                            "id-ID",
                            {
                                day: "numeric",
                                month: "long",
                                year: "numeric",
                            }
                        )
                    }}</td>
                   <td>{{ item.columns.sesi_perijinan_instruktur }}</td>  
                    <td>{{ item.columns.keterangan_perijinan_instruktur }}</td>
                    <td>
                        <v-menu>
                            <template v-slot:activator="{ props }">
                                <v-btn density="compact" size="small" icon="mdi:mdi-dots-vertical" flat
                                    v-bind="props"></v-btn>
                            </template>

                            <v-list density="compact">
                                <v-list-item @click="showDialog('Edit', item.columns.id)">
                                    <v-list-item-title>
                                        Konfirmasi
                                    </v-list-item-title>
                                </v-list-item>
                                <v-list-item @click="deleteInstruktur(item.columns.id)">
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
    name: "Perijinan",
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
                { key: "nama_instruktur", title: "Instruktur" },
                { key: "jenis_kelas", title: "Kelas" },
                { key: "status_kelas_harian", title: "Status" },
                { key: "tanggal_kelas_harian", title: "tanggal" },
                { key: "sesi_perijinan_instruktur", title: "Sesi" },
                { key: "keterangan_perijinan_instruktur", title: "Keterangan" },
                { key: "id", title: "" },
                { key: "id_jadwal_harian", title: "" },
            ],
            showPassword: false,
            errors: {},
            perijinan: [],
            instrukturs: [],
            form: {},
        };
    },
    methods: {
        showDialog(type, id) {
            if (type == "Add") {
                this.dialogTitle = "Tambah Perijinan";
                this.form = {};
            } else if (type == "Edit") {
                this.dialogTitle = "Konfirmasi Perijinan";
                UserService.getPerijinan(id).then((response) => {
                    if (response.data.success) {
                        this.form = response.data.data;
                    }
                });
            }
            this.dialog = true;
            UserService.getInstrukturList().then((response) => {
                if (response.data.success) {
                    this.instrukturs = response.data.data;
                }
            });
            this.errors = {};
        },
        submitForm() {
            this.errors = {};
            if (this.form.id) {
                UserService.editPerijinan(this.form).then(
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
                UserService.addPerijinan(this.form).then(
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
                this.getPerijinanList();
            }
        },
        getPerijinanList() {
            UserService.getPerijinanList().then((response) => {
                if (response.data.success) {
                    this.perijinan = response.data.data;
                }
            });
        },
        deletePerijinan(id) {
            UserService.deletePerjinan(id).then(
                (response) => {
                    this.$store.dispatch("snackbar/showSnack", {
                        message: response.data.message,
                        color: response.data.success ? "success" : "error",
                    });
                    this.getPerjinanList();
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
