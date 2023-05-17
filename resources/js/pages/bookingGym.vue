<template>
    <v-dialog v-model="printDialog" width="500px">
            <v-card class="mb-2">
                <v-card-text id="memberCard">
                    <div
                        style="
                        margin-bottom: 16px;
                        border: 2px solid;
                        background-color: #fff;
                    "
                    >
                        <div style="padding: 16px">
                            <h2 style="margin: 0">GoFit</h2>
                            <p style="margin: 0">
                                Jl. Centralpark no.15, Yogyakarta
                            </p>
                        </div>
                        <div style="padding: 16px">
                            <h3 style="margin-top: 0">STRUK PRESENSI GYM</h3>
                            <p style="margin: 0">
                                No Struk&emsp;&emsp;: {{ print.id_booking_gym }}
                            </p>
             
                            <p style="margin: 0">
                                Tanggal&emsp;&emsp;&ensp;: {{
                                    new Date(print.tanggal_booking_gym).toLocaleDateString(
                                        "id-ID",
                                        {
                                            day: "numeric",
                                            month: "long",
                                            year: "numeric",
                                        }
                                    )
                                }}
                            </p>
   
                        </div>
                        <div style="padding: 16px">
                            <p style="margin: 0">
                                <strong>Member&emsp;&emsp;:</strong>{{ print.id_member }}/{{ print.nama_member }}
                            </p>
                            <p style="margin: 0">
                                Slot Waktu&emsp;: {{ print.sesi_gym }}
                            </p>
                        </div>
                    </div>
                </v-card-text>
            </v-card>
            <v-btn color="success" class="mb-2" @click="printCard">Print</v-btn>
            <v-btn text @click="printDialog = false">Close</v-btn>
        </v-dialog>
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
                                <v-text-field v-model="form.sesi_gym"
                                    hidden></v-text-field>
                                <v-text-field v-model="form.jumlah_kapasitas_gym"
                                        hidden></v-text-field>
                                <v-text-field v-model="form.tanggal_booking_gym" hidden></v-text-field>
                                <v-col cols="12">
                                    <span class="text-primary">Nama Member: {{ form.nama_member }}</span>
                                </v-col>
                                <v-col cols="12">
                                    <span class="text-secondary">Sesi: {{ form.sesi_gym }}</span>
                                </v-col>
                                <v-col cols="12">
                                    <span class="text-dark">Nama Pegawai: {{ form.nama_pegawai }}</span>
                                </v-col>
                                <v-col cols="12">
                                    <span class="text-dark">Tanggal Presensi: {{
                                        new Date(form.tanggal_booking_gym).toLocaleDateString(
                                            "id-ID",
                                            {
                                                day: "numeric",
                                                month: "long",
                                                year: "numeric",
                                            }
                                        )
                                    }}</span>
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
                    <v-btn color="blue-darken-1" variant="text" @click="cetakStruk(form.id_booking_gym)">
                        Presensi
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
        <v-data-table :headers="headers" :items="bookingGymItem" :search="search" item-value="name"
            class="elevation-1 rounded rounded-lg sha" @update:options="getBookingGymList"
            @update:aktivasBookingGym="getBookingGymList">
            
            <template v-slot:item="{ item }">
                <tr>
                    <td>{{ item.columns.nama_pegawai }}</td>
                    <td>{{ item.columns.nama_member }}</td>
                    
                     
                    <td><span v-if="item.columns.sesi_gym == null" class="text-warning">Belum Aktif</span>
                        <span v-else class="text-success">{{ item.columns.sesi_gym }}</span></td>
                  <td><span v-if="item.columns.jumlah_kapasitas_gym == null" class="text-warning">Belum Aktif</span>
                            <span v-else class="text-success">{{ item.columns.jumlah_kapasitas_gym }}</span></td>  
                <td>
                                <span v-if="item.columns.tanggal_booking_gym == null" class="text-warning">Belum Aktif</span>
                                <span v-else class="text-success">{{
                                    new Date(
                                        item.columns.tanggal_booking_gym
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
                    <td>
                        <v-menu>
                            <template v-slot:activator="{ props }">
                                <v-btn density="compact" size="small" icon="mdi:mdi-dots-vertical" flat
                                    v-bind="props"></v-btn>
                            </template>

                            <v-list density="compact">
                                <v-list-item @click="showDialog('Edit', item.columns.id_booking_gym)">
                                    <v-list-item-title>
                                        Konfirmasi
                                    </v-list-item-title>
                                </v-list-item>
                                <v-list-item @click="deleteBookingGym(item.columns.id_booking_gym)">
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
    name: "BookingGym",
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
                { key: "sesi_gym", title: "Sesi" },
                { key: "jumlah_kapasitas_gym", title: "Kapasitas Gym" },
                { key: "tanggal_booking_gym", title: "Tanggal Booking" }, 
                { key: "id_booking_gym", title: "" },
            ],
            showPassword: false,
            printDialog: false,
            errors: {},
            bookingGymItem: [],
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
        showDialog(type, id_booking_gym) {
            if (type == "Add") {
                this.dialogTitle = "Tambah Perijinan";
                this.form = {};
            } else if (type == "Edit") {
                this.dialogTitle = "Presensi Member";
                UserService.getBookingGym(id_booking_gym).then((response) => {
                    if (response.data.success) {
                        this.form = response.data.data;
                    }
                });
            }
            this.dialog = true;
            this.errors = {};
        },
        printCard() {
            this.submitForm();
            this.getBookingGymList();
            let printContents = document.getElementById("memberCard").innerHTML;
            let printWindow = window.open("", "_blank", "height=500,width=500");
            
            printWindow.document.write(
                "<html><head><title>Cetak Struk Presensi</title></head><body>"
            );
            printWindow.document.write(printContents);
            printWindow.document.write("</body></html>");
            printWindow.document.close();
            printWindow.print({ silent: true });
            printWindow.close();
        },
        cetakStruk(id_booking_gym){
            UserService.getBookingGym(id_booking_gym).then((response) => {
                if (response.data.success) {
                    this.print = response.data.data;
                    this.printDialog = true;
                }
            });
        },
        submitForm() {
            this.errors = {};
            if (this.form.id_booking_gym) {
                UserService.editBookingGym(this.form).then(
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
                UserService.addBookingGym(this.form).then(
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
                this.getBookingGymList();
            }
        },
        getBookingGymList() {
            UserService.getBookingGymList().then((response) => {
                if (response.data.success) {
                    this.bookingGymItem = response.data.data;
                }
            });
        },
        deleteBookingGym(id) {
            UserService.deleteBookingGym(id).then(
                (response) => {
                    this.$store.dispatch("snackbar/showSnack", {
                        message: response.data.message,
                        color: response.data.success ? "success" : "error",
                    });
                    this.getBookingGymList();
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
