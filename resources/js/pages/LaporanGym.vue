<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent width="800">
            <v-card>
                <v-card-text>
                    <v-container id="laporanBulananId">
                        <table style="
                        border-collapse: collapse;
                        border-spacing: 0;
                        width: 100%;">
                            <thead>
                                <tr>
                                    <th style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            font-weight: normal;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top
                                " colspan="4">
                                        <div style="padding: 5px">
                                            <h2 style="margin: 0">GoFit</h2>
                                            <p style="margin: 0">
                                                Jl. Centralpark no.15, Yogyakarta
                                            </p>
                                        </div>
                                        <div style="padding: 5px;
                                    display: grid;">
                                            <u><b>LAPORAN PENDAPATAN BULANAN</b></u>
                                        <u><span>Bulan: {{ form.bulan }}</span>   <span>Tahun: {{ form.tahun }}</span></u>

                                            <span>Tanggal Cetak: {{
                                                new Date().toLocaleDateString(
                                                    "id-ID",
                                                    {
                                                        day: "numeric",
                                                        month: "long",
                                                        year: "numeric",
                                                    }
                                                )
                                            }}</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Tanggal</td>
                                    <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Jumlah Peserta</td>
                                  
                                </tr>
                                <tr v-for="(item, index) in printItem" :key="index">
                                    <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span>{{
                                                new Date(item.tanggal_booking_gym).toLocaleDateString(
                                                    "id-ID",
                                                    {
                                                        day: "numeric",
                                                        month: "long",
                                                        year: "numeric",
                                                    }
                                                )
                                                                                            }}</span></td>
                                    <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span>{{ item.jumlah_peserta }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
                        Batal
                    </v-btn>
                    <v-btn color="blue-darken-1" variant="text" @click="printLaporan">
                        Cetak
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>

    <v-card>
    <v-container>
        <v-row class="my-4 mx-auto">
            <v-text-field density="compact" hide-details v-model="form.bulan" label="Bulan (dalam Angka)" variant="outlined"
                append-inner-icon="mdi:mdi-magnify"></v-text-field>

            <v-text-field class="mx-4" density="compact" hide-details v-model="form.tahun" label="Tahun" variant="outlined"
                append-inner-icon="mdi:mdi-magnify"></v-text-field>
            <v-btn prepend-icon="mdi:mdi-plus" color="success" @click="showDialog">
                Cetak Laporan
            </v-btn>

        </v-row>
    </v-container>
    </v-card>
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
            showPassword: false,
            errors: {},
            laporanKelasItem: [],
            printItem: [],
            form: {},
            headers: [
                {
                    align: "start",
                    key: "jenis_kelas",
                    sortable: false,
                    title: "Nama Kelas",
                },
                { key: "nama_instruktur", title: "Nama instruktur" },
                { key: "jumlah_peserta", title: "Jumlah Peserta" },
            ],
        };
    },
    computed: {
        filteredObject() {
            return this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 4);
        },
    },
    methods: {
        printLaporan() {
            this.cariLaporanGym
            let printContents = document.getElementById("laporanBulananId").innerHTML;
            let printWindow = window.open("", "_blank", "height=500,width=500");

            printWindow.document.write(
                "<html><head><title>Cetak Laporan Aktivitas Kelas</title></head><body>"
            );
            printWindow.document.write(printContents);
            printWindow.document.write("</body></html>");
            printWindow.document.close();
            printWindow.print({ silent: true });
            printWindow.close();
        },
        hitungTotalBulanan(value) {
            if (this.form.Jumlah_Aktivasi.some(obj => obj.bulan === value)) {
                return this.formattedCurrency(parseInt(this.hitungJumlahDeposit(value)) + parseInt(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === value).jumlah_aktivasi))
            } else {
                return this.formattedCurrency(this.hitungJumlahDeposit(value))
            }
        },
        hitungJumlahDeposit(value) {
            if (this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === value) && this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === value)) {
                return parseInt(this.form.Jumlah_Deposit_Kelas.find((obj) => obj.bulan === value).jumlah_deposit_kelas) + parseInt(this.form.Jumlah_Deposit_Uang.find((obj) => obj.bulan === value).jumlah_deposit_uang)
            } else if (this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === value)) {
                return this.form.Jumlah_Deposit_Kelas.find((obj) => obj.bulan === value).jumlah_deposit_kelas
            } else if  (this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === value)){
                this.form.Jumlah_Deposit_Uang.find((obj) => obj.bulan === value).jumlah_deposit_uang
            } else{
                return 0
            }
        },
        formattedCurrency(value) {
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
            return formatter.format(value);
        },
        showDialog() {
            this.errors = {};
            UserService.cariLaporanGym(this.form).then(
                (response) => {
                    this.$store.dispatch("snackbar/showSnack", {
                        message: response.data.message,
                        color: response.data.success ? "success" : "error",
                    });
                    this.printItem = response.data.data
                    this.dialog = true
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
                    this.dialog = false;
                }
            );
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
        cariLaporanGym() {
            UserService.cariLaporangym(this.form).then(
                (response) => {
                    this.$store.dispatch("snackbar/showSnack", {
                        message: response.data.message,
                        color: response.data.success ? "success" : "error",
                    });
                    this.printItem = response.data.data
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
                }
            );
        },
        getLaporanKelas() {
            UserService.getLaporanKelas().then((response) => {
                if (response.data.success) {
                    this.laporanKelasItem = response.data.data;
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
