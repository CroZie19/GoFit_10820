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
                                <v-text-field v-model="form.id_pegawai" 
                                    hidden></v-text-field>
                                <v-text-field v-model="form.id_member"
                                    hidden></v-text-field>
                                <v-text-field v-model="form.jumlah_pembayaran_aktivasi"
                                    hidden></v-text-field>
                                <v-text-field v-model="form.metode_pembayaran_aktivasi"
                                        hidden></v-text-field>
                                <v-text-field v-model="form.tanggal_kelas_harian" hidden></v-text-field>
                                <v-col cols="12">
                                    <span class="text-primary">Nama Member: {{ form.nama_member }}</span>
                                </v-col>
                                <v-col cols="12">
                                    <span class="text-primary">Nama Pegawai: {{ form.nama_pegawai }}</span>
                                </v-col>
                                <v-col cols="12">
                                    <span class="text-primary">Tanggal Aktivasi: {{
                                        new Date().toLocaleDateString(
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
                                    <span class="text-success">Jumlah Pembayaran: Rp 3.000.000</span>
                                </v-col>
                                <v-col cols="12">
                                    <label for="metode_pembayaran" class="block text-sm text-gray-700">Metode Pembayaran<span class="text-red-700">*</span></label>
                                    <select id="metode_pembayaran" v-model="form.metode_pembayaran_aktivasi" name="metode_pembayaran"
                                        autocomplete="metode_pembayaran"
                                        class="border border-dark w-100 py-2 px-2 custom-select custom-select-lg">
                                        <option value="cash">
                                            Cash
                                        </option>
                                        <option value="debit">
                                            Debit
                                        </option>
                                        <option value="qris">
                                            Qris
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
                        Bayar
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>

    <v-container>
        <v-row class="mt-4 mx-auto">
            <v-text-field class="pr-4" density="compact" hide-details v-model="search" label="Cari Data" variant="outlined"
                append-inner-icon="mdi:mdi-magnify"></v-text-field>
            

        </v-row>
    </v-container>
    <v-container>
        <v-data-table :headers="headers" :items="aktivasiItem" :search="search" item-value="name"
            class="elevation-1 rounded rounded-lg sha" @update:options="getAktivasiList"
            @update:aktivasiItem="getAktivasiList">
            <template v-slot:item="{ item }">
                <tr>
                    <td>{{ item.columns.nama_pegawai }}</td>
                    <td>{{ item.columns.nama_member }}</td>
                    
                     <td>
                            <span v-if="item.columns.tanggal_transaksi_aktivasi == null" class="text-warning">Belum Aktif</span>
                            <span v-else class="text-success">{{
                                new Date(
                                    item.columns.tanggal_transaksi_aktivasi
                                ).toLocaleDateString(
                                    "id-ID",
                                    {
                                        day: "numeric",
                                        month: "long",
                                        year: "numeric",
                                    }
                                )
                                }}</span>
                    </td>
                    <td><span v-if="item.columns.jumlah_pembayaran_aktivasi == null" class="text-warning">Belum Aktif</span>
                        <span v-else class="text-success">{{ formattedCurrency(item.columns.jumlah_pembayaran_aktivasi) }}</span></td>
                  <td><span v-if="item.columns.metode_pembayaran_aktivasi == null" class="text-warning">Belum Aktif</span>
                            <span v-else class="text-success">{{ item.columns.metode_pembayaran_aktivasi }}</span></td>  
                  <td><span v-if="item.columns.jumlah_deposit_member == null" class="text-warning">Belum Aktif</span>
                                <span v-else class="text-success">{{ formattedCurrency(item.columns.jumlah_deposit_member) }}</span></td>  
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
                                <v-list-item @click="deleteAktivasi(item.columns.id)">
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
    name: "Aktivasi",
    data() {
        return {
            dialogTitle: "",
            dialog: false,
            search: "",
            loading: true,
            headers: [
                {
                    align: "start",
                    key: "nama_pegawai",
                    sortable: false,
                    title: "Nama Pegawai",
                },
                { key: "nama_member", title: "Nama Member" },
                { key: "tanggal_transaksi_aktivasi", title: "Tanggal Aktivasi" },
                { key: "jumlah_pembayaran_aktivasi", title: "Jumlah Pembayaran" },
                { key: "metode_pembayaran_aktivasi", title: "Metode Pembayaran" },
                { key: "jumlah_deposit_member", title: "Jumlah Deposit" },
                // { key: "id_pegawai", title: "" },
                // { key: "id_member", title: "" },
                { key: "id", title: "" },
            ],
            showPassword: false,
            errors: {},
            aktivasiItem: [],
            form: {},
        };
    },
    methods: {
        formattedCurrency(value) {
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
            return formatter.format(value);
        },
        showDialog(type, id) {
            if (type == "Add") {
                this.dialogTitle = "Tambah Perijinan";
                this.form = {};
            } else if (type == "Edit") {
                this.dialogTitle = "Aktivasi Member";
                UserService.getAktivasi(id).then((response) => {
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
                UserService.editAktivasi(this.form).then(
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
                UserService.addAktivasi(this.form).then(
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
                this.getAktivasiList();
            }
        },
        getAktivasiList() {
            UserService.getAktivasiList().then((response) => {
                if (response.data.success) {
                    this.aktivasiItem = response.data.data;
                }
            });
        },
        deleteAktivasi(id) {
            UserService.deleteAktivasi(id).then(
                (response) => {
                    this.$store.dispatch("snackbar/showSnack", {
                        message: response.data.message,
                        color: response.data.success ? "success" : "error",
                    });
                    this.getAktivasiList();
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
