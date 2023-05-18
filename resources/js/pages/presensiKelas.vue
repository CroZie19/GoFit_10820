
<template>
       <v-dialog v-model="printDialogPaket" width="500px">
            <v-card class="mb-2">
                <v-card-text id="memberCard">
                    <div style="
                            margin-bottom: 16px;
                            border: 2px solid;
                            background-color: #fff;
                        ">
                        <div style="padding: 16px">
                            <h2 style="margin: 0">GoFit</h2>
                            <p style="margin: 0">
                                Jl. Centralpark no.15, Yogyakarta
                            </p>
                        </div>
                        <div style="padding: 16px">
                            <h3 style="margin-top: 0">STRUK PRESENSI KELAS PAKET</h3>
                            <p style="margin: 0">
                                No Struk&emsp;&emsp;: {{ print.id_booking_kelas }}
                            </p>

                            <p style="margin: 0">
                                Tanggal&emsp;&emsp;&ensp;: {{
                                    new Date(print.tanggal_booking_kelas).toLocaleDateString(
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
                                Kelas  &emsp;&emsp;&emsp;: {{ print.jenis_kelas }}
                            </p>
                            <p style="margin: 0">
                                Instruktur &emsp;: {{ print.nama_instruktur }}
                            </p>
                            <p style="margin: 0">
                                Sisa Deposit: {{ print.jumlah_deposit_paket }}x
                            </p>
                            <p style="margin: 0">
                                Berlaku Sampai: {{
                                    new Date(print.tanggal_kardaluasa_member).toLocaleDateString(
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
                    </div>
                </v-card-text>
            </v-card>
            <v-btn color="success" class="mb-2" @click="printCardPaket">Print</v-btn>
            <v-btn text @click="printDialogPaket = false">Close</v-btn>
        </v-dialog>
        <v-dialog v-model="printDialogRegular" width="500px">
            <v-card class="mb-2">
                    <v-card-text id="memberCardRegular">
                        <div style="
                            margin-bottom: 16px;
                            border: 2px solid;
                            background-color: #fff;
                        ">
                            <div style="padding: 16px">
                                <h2 style="margin: 0">GoFit</h2>
                                <p style="margin: 0">
                                    Jl. Centralpark no.15, Yogyakarta
                                </p>
                            </div>
                            <div style="padding: 16px">
                                <h3 style="margin-top: 0">STRUK PRESENSI KELAS</h3>
                                <p style="margin: 0">
                                    No Struk&emsp;&emsp;: {{ print.id_booking_kelas }}
                                </p>

                                <p style="margin: 0">
                                    Tanggal&emsp;&emsp;&ensp;: {{
                                        new Date(print.tanggal_booking_kelas).toLocaleDateString(
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
                                    Kelas  &emsp;&emsp;&emsp;: {{ print.jenis_kelas }}
                                </p>
                                <p style="margin: 0">
                                    Instruktur &emsp;: {{ print.nama_instruktur }}
                                </p>
                                <p style="margin: 0">
                                    Tarif  &emsp;&emsp;&emsp;: {{ formattedCurrency(print.harga_kelas) }}
                                </p>
                                <p style="margin: 0">
                                    Sisa Deposit: {{ formattedCurrency(print.jumlah_deposit_member) }}
                                </p>
                            </div>
                        </div>
                    </v-card-text>
                </v-card>
                <v-btn color="success" class="mb-2" @click="printCardRegular">Print</v-btn>
                <v-btn text @click="printDialogRegular = false">Close</v-btn>
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
                            <pre>{{ form }}</pre>
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
                                    <span class="text-primary">Tanggal Booking: {{
                                        new Date(form.tanggal_booking_kelas).toLocaleDateString(
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
                                    <span class="text-dark">Sesi Kelas: {{ form.sesi_kelas }}</span>
                                </v-col>
                                <v-col cols="12">
                                    <label for="presensi" class="block text-sm text-gray-700">Konfirmasi Presensi<span class="text-warning">*</span></label>
                                    <select id="presensi" v-model="form.status_presensi" name="presensi"
                                        autocomplete="presensi"
                                        class="border border-dark w-100 py-2 px-2 custom-select custom-select-lg">
                                        <option value="1">
                                            Kelas Paket
                                        </option>
                                        <option value="0">
                                            Kelas Regular
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
                    <v-btn color="blue-darken-1" variant="text" @click="cetakStruk(form.id_booking_kelas)">
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
        <v-data-table :headers="headers" :items="bookingKelasItem" :search="search" item-value="name"
            class="elevation-1 rounded rounded-lg sha" @update:options="getBookingKelasList"
            @update:bookingKelasItem="getBookingKelasList">
            <template v-slot:item="{ item }">
                <tr>
                    <td>{{ item.columns.nama_pegawai }}</td>
                    <td>{{ item.columns.nama_member }}</td>
                    
                     <td>
                            <span v-if="item.columns.jumlah_deposit_member == null" class="text-warning">Kosong</span>
                                    <span v-else class="text-success">{{ formattedCurrency(item.columns.jumlah_deposit_member) }}</span>
                    </td>
                    <td><span v-if="item.columns.jumlah_deposit_paket == null" class="text-warning">Kosong</span>
                        <span v-else class="text-success">{{ (item.columns.jumlah_deposit_paket) }}x</span></td>
                  <td><span v-if="item.columns.sesi_kelas == null" class="text-warning">Kosong</span>
                            <span v-else class="text-success">{{ item.columns.sesi_kelas }}</span></td>  
                  <td>
                            
                            <span v-if="item.columns.tanggal_booking_kelas == null" class="text-warning">Kosong</span>
                                <span v-else class="text-success">{{
                                    new Date(
                                        item.columns.tanggal_booking_kelas
                                    ).toLocaleDateString(
                                        "id-ID",
                                        {
                                            day: "numeric",
                                            month: "long",
                                            year: "numeric",
                                        }
                                    )
                                }}</span></td>  
                    <td>
                        <v-menu>
                            <template v-slot:activator="{ props }">
                                <v-btn density="compact" size="small" icon="mdi:mdi-dots-vertical" flat
                                    v-bind="props"></v-btn>
                            </template>

                            <v-list density="compact">
                                <v-list-item @click="showDialog('Edit', item.columns.id_booking_kelas)">
                                    <v-list-item-title>
                                        Konfirmasi
                                    </v-list-item-title>
                                </v-list-item>
                                <v-list-item @click="deleteAktivasi(item.columns.id_booking_kelas)">
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
    name: "BookingKelas",
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
                { key: "jumlah_deposit_member", title: "Jumlah Deposit Member" },
                { key: "jumlah_deposit_paket", title: "Jumlah Deposit Kelas" },
                { key: "sesi_kelas", title: "Sesi" },
                { key: "tanggal_booking_kelas", title: "Tanggal" },
                // { key: "id_member", title: "" },
                { key: "id_booking_kelas", title: "" },
            ],
            showPassword: false,
            errors: {},
            bookingKelasItem: [],
            form: {},
            print:{},
            printDialogPaket: false,
            printDialogRegular: false,
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
        printCardPaket() {
            this.submitForm();
            this.getBookingKelasList();
            let printContents = document.getElementById("memberCard").innerHTML;
            let printWindow = window.open("", "_blank", "height=500,width=500");

            printWindow.document.write(
                "<html><head><title>Presensi Member Paket</title></head><body>"
            );
            printWindow.document.write(printContents);
            printWindow.document.write("</body></html>");
            printWindow.document.close();
            printWindow.print({ silent: true });
            printWindow.close();
        },
        printCardRegular() {
            this.submitForm();
            this.getBookingKelasList();
            let printContents = document.getElementById("memberCardRegular").innerHTML;
            let printWindow = window.open("", "_blank", "height=500,width=500");

            printWindow.document.write(
                "<html><head><title>Presensi Member Regular</title></head><body>"
            );
            printWindow.document.write(printContents);
            printWindow.document.write("</body></html>");
            printWindow.document.close();
            printWindow.print({ silent: true });
            printWindow.close();
        },
        showDialog(type, id) {
            if (type == "Add") {
                this.dialogTitle = "Tambah Perijinan";
                this.form = {};
            } else if (type == "Edit") {
                this.dialogTitle = "Presensi Kelas";
                UserService.getBookingKelas(id).then((response) => {
                    if (response.data.success) {
                        this.form = response.data.data;
                    }
                });
            }
            this.dialog = true;
            this.errors = {};
        },
        cetakStruk(id_booking_kelas) {
            UserService.getBookingKelas(id_booking_kelas).then((response) => {
                if (response.data.success) {
                    this.print = response.data.data;
                    if(this.form.status_presensi == 1){
                        this.printDialogPaket = true;
                    }else{
                        this.printDialogRegular = true;
                    }
                }
            });
        },
        submitForm() {
            this.errors = {};
            if (this.form.id_booking_kelas) {
                UserService.editBookingKelas(this.form).then(
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
                UserService.addBookingKelas(this.form).then(
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
                this.getBookingKelasList();
            }
        },
        getBookingKelasList() {
            UserService.getBookingKelasList().then((response) => {
                if (response.data.success) {
                    this.bookingKelasItem = response.data.data;
                }
            });
        },
        deleteBookingKelas(id) {
            UserService.deleteBookingKelas(id).then(
                (response) => {
                    this.$store.dispatch("snackbar/showSnack", {
                        message: response.data.message,
                        color: response.data.success ? "success" : "error",
                    });
                    this.getBookingKelasList();
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
