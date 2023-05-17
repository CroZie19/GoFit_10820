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
                        <h3 style="margin-top: 0">Member Card</h3>
                        <p style="margin: 0">
                            MemberID&emsp;: {{ print.nomor_member }}
                        </p>
                        <p style="margin: 0">
                            Nama&emsp;&emsp;&emsp;: {{ print.nama_member }}
                        </p>
                        <p style="margin: 0">
                            Alamat&emsp;&emsp;&ensp;: {{ print.alamat_member }}
                        </p>
                        <p style="margin: 0">
                            Telepon&emsp;&emsp;: {{ print.noTelp_member }}
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
                                <v-col cols="12">
                                    <v-text-field
                                        label="Nama*"
                                        v-model="form.nama_member"
                                        :error-messages="errors.nama_member"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12">
                                    <v-text-field
                                        label="Alamat*"
                                        v-model="form.alamat_member"
                                        :error-messages="errors.alamat_member"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12">
                                    <v-text-field
                                        label="Tanggal Lahir*"
                                        v-model="form.tanggal_lahir_member"
                                        :error-messages="errors.tanggal_lahir_member"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12">
                                    <v-text-field
                                        label="Nomor Telephone*"
                                        v-model="form.noTelp_member"
                                        :error-messages="errors.noTelp_member"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field
                                        label="Email*"
                                        v-model="form.email"
                                        :error-messages="errors.email"
                                        required
                                    ></v-text-field>
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
                    Tambah Member
                </v-btn>
            </v-col>

            <v-col cols="12" md="4" align-self="center">
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
            :items="members"
            :search="search"
            item-value="name"
            class="elevation-1"
            @update:options="getMemberList"
            @update:members="getMemberList"
        >
            <template v-slot:item="{ item }">
                <tr>
                    <td>{{ item.columns.id }}</td>
                    <td>{{ item.columns.nama_member }}</td>
                    <td>{{ item.columns.alamat_member }}</td>
                    
                    <td>{{ item.columns.noTelp_member }}</td>
                    <td>{{ item.columns.email }}</td>
                    <td>{{ item.columns.tanggal_kardaluasa_member }}</td>
                    <td>{{ item.columns.jumlah_deposit_member }}</td>
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
                                    @click="showPrintDialog(item.columns.id)"
                                >
                                    <v-list-item-title>
                                        Cetak Kartu
                                    </v-list-item-title>
                                </v-list-item>
                                <v-list-item
                                    @click="showDialog('Edit', item.columns.id)"
                                >
                                    <v-list-item-title>
                                        Edit
                                    </v-list-item-title>
                                </v-list-item>
                                <v-list-item
                                    @click="deleteMember(item.columns.id)"
                                >
                                    <v-list-item-title>
                                        Hapus
                                    </v-list-item-title>
                                </v-list-item>
                                <v-list-item
                                    @click="resetPassword(item.columns.id)"
                                >
                                    <v-list-item-title>
                                        Reset Password
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
    name: "Member",
    data() {
        return {
            dialogTitle: "",
            printDialog: false,
            dialog: false,
            search: "",
            loading: true,
            headers: [
                {
                    align: "start",
                    key: "nomor_member",
                    sortable: false,
                    title: "ID",
                },
                { key: "nama_member", title: "Nama" },
                { key: "alamat_member", title: "Alamat" },
                { key: "noTelp_member", title: "Telp" },
                { key: "email", title: "Email" },
                { key: "tanggal_kardaluasa_member", title: "Kadaluwarsa" },
                { key: "jumlah_deposit_member", title: "Saldo" },
                { key: "id", title: "" },
            ],
            errors: {},
            members: [],
            print: {},
            form: {},
        };
    },

    // mounted() {
    //     UserService.getMemberList().then((response) => {
    //         if (response.data.success) {
    //             this.members = response.data.data;
    //         }
    //     });
    // },

    methods: {
        printCard() {
            let printContents = document.getElementById("memberCard").innerHTML;
            let printWindow = window.open("", "_blank", "height=500,width=500");
            printWindow.document.write(
                "<html><head><title>Cetak Member Card</title></head><body>"
            );
            printWindow.document.write(printContents);
            printWindow.document.write("</body></html>");
            printWindow.document.close();
            printWindow.print({ silent: true });
            printWindow.close();
        },
        showPrintDialog(id) {
            UserService.getMember(id).then((response) => {
                if (response.data.success) {
                    this.print = response.data.data;
                    this.printDialog = true;
                }
            });
        },
        showDialog(type, id) {
            if (type == "Add") {
                this.dialogTitle = "Tambah Member";
                this.form = {};
            } else if (type == "Edit") {
                this.dialogTitle = "Edit Member";
                UserService.getMember(id).then((response) => {
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
                UserService.editMember(this.form).then(
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
                UserService.addMember(this.form).then(
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
                this.getMemberList();
            }
        },
        getMemberList() {
            UserService.getMemberList().then((response) => {
                if (response.data.success) {
                    this.members = response.data.data;
                }
            });
        },
        deleteMember(id) {
            UserService.deleteMember(id).then(
                (response) => {
                    this.$store.dispatch("snackbar/showSnack", {
                        message: response.data.message,
                        color: response.data.success ? "success" : "error",
                    });
                    this.getMemberList();
                },
                (error) => {
                    this.$store.dispatch("snackbar/showSnack", {
                        message: error.message,
                        color: "error",
                    });
                }
            );
        },
        resetPassword(id) {
            UserService.resetPasswordMember(id).then(
                (response) => {
                    this.$store.dispatch("snackbar/showSnack", {
                        message: response.data.message,
                        color: response.data.success ? "success" : "error",
                    });
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
