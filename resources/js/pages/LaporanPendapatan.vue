<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent width="800">
            <v-card>
                <v-card-title class="text-center">
                    <span class="text-h5 text-center">{{ dialogTitle }}</span>
                </v-card-title>
                <v-card-text id="laporanBulananId">
                    <v-container >
                        <table style="
                        border-collapse: collapse;
                        border-spacing: 0;
                        width: 100%;" 
                        >
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
                                        <span>Periode: {{ search }}</span>
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
                                            vertical-align: top"
                                            
                               >Bulan</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Aktivasi</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Deposit</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Total</td>
                            </tr>
                            <tr v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 1) || this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 1) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 1)" >
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Januari</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 1)">{{ formattedCurrency(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 1).jumlah_aktivasi) }}</span></td>
                                <td  style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 1) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 1)">{{ formattedCurrency(hitungJumlahDeposit(1)) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{hitungTotalBulanan(1)}}</td>
                            </tr>
                            <tr v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 2) || this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 2) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 2)">
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Februari</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 2)">{{ formattedCurrency(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 2).jumlah_aktivasi) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 2) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 2)">{{ formattedCurrency(hitungJumlahDeposit(2)) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{ hitungTotalBulanan(2) }}</td>
                            </tr>
                            <tr v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 3) || this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 3) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 3)">
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Maret</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 3)">{{ formattedCurrency(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 3).jumlah_aktivasi) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 3) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 3)">{{ formattedCurrency(hitungJumlahDeposit(3)) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{ hitungTotalBulanan(3) }}</td>
                            </tr>
                            <tr v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 4) || this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 4) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 4)">
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">April</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 4)">{{ formattedCurrency(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 4).jumlah_aktivasi) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 4) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 4)">{{ formattedCurrency(hitungJumlahDeposit(4)) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{ hitungTotalBulanan(4) }}</td>
                            </tr>
                            <tr v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 5) || this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 5) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 5)">
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Mei</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 5)">{{ formattedCurrency(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 5).jumlah_aktivasi) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 5) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 5)">{{ formattedCurrency(hitungJumlahDeposit(5)) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{ hitungTotalBulanan(5) }}</td>
                            </tr>
                            <tr v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 6) || this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 6) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 6)">
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Juli</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 6)">{{ formattedCurrency(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 6).jumlah_aktivasi) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 6) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 6)">{{ formattedCurrency(hitungJumlahDeposit(6)) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{ hitungTotalBulanan(6) }}</td>
                            </tr>
                            <tr v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 7) || this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 7) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 7)">
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Juni</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 7)">{{ formattedCurrency(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan ===7).jumlah_aktivasi) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 7) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 7)">{{ formattedCurrency(hitungJumlahDeposit(7)) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{ hitungTotalBulanan(7) }}</td>
                            </tr>
                            <tr v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 8) || this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 8) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 8)">
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Agustus</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 8)">{{ formattedCurrency(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 8).jumlah_aktivasi) }}</span></td>
                                <td  style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 8) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 8)">{{ formattedCurrency(hitungJumlahDeposit(8)) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{ hitungTotalBulanan(8) }}</td>
                            </tr>
                            <tr v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 9) || this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 9) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 9)">
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">September</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 9)">{{ formattedCurrency(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 9).jumlah_aktivasi) }}</span></td>
                                <td  style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 9) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 9)">{{ formattedCurrency(hitungJumlahDeposit(9)) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{ hitungTotalBulanan(9) }}</td>
                            </tr>
                            <tr v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 10) || this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 10) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 10)">
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Oktober</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 10)">{{ formattedCurrency(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 10).jumlah_aktivasi) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 10) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 10)">{{ formattedCurrency(hitungJumlahDeposit(10)) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{ hitungTotalBulanan(10) }}</td>
                            </tr>
                            <tr v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 11) || this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 11) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 11)">
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">November</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 11)">{{ formattedCurrency(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 11).jumlah_aktivasi) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 11) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 11)">{{ formattedCurrency(hitungJumlahDeposit(11)) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{ hitungTotalBulanan(11) }}</td>
                            </tr>
                            <tr v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 12) || this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 12) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 12)">
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">Desember</td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Aktivasi.some(obj => obj.bulan === 12)">{{ formattedCurrency(this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 12).jumlah_aktivasi) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top"><span v-if="this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === 12) || this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === 12)">{{ formattedCurrency(hitungJumlahDeposit(12)) }}</span></td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{ hitungTotalBulanan(12) }}</td>
                            </tr>
                            <tr>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: right;
                                            vertical-align: top" colspan="3">
                                   <span>Total</span>
                                </td>
                                <td style="border-color: black;
                                            border-style: solid;
                                            border-width: 1px;
                                            font-family: Arial, sans-serif;
                                            font-size: 14px;
                                            overflow: hidden;
                                            padding: 10px 5px;
                                            word-break: normal;
                                            text-align: left;
                                            vertical-align: top">{{ formattedCurrency(parseInt(this.form.Jumlah_Aktivasi.reduce((total, obj) => total + parseInt(obj.jumlah_aktivasi), 0)) +  parseInt(this.form.Jumlah_Deposit_Kelas.reduce((total, obj) => total + parseInt(obj.jumlah_deposit_kelas), 0)) + parseInt(this.form.Jumlah_Deposit_Uang.reduce((total, obj) => total + parseInt(obj.jumlah_deposit_uang), 0))) }}</td>
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

    <v-container>
        <v-card >
            <div class="mx-4 my-4">
                <span>Silahkan cari periode laporan pendapatan bulanan:</span>
                <div class="d-flex mt-2" >
                    <v-text-field class="pr-4" density="compact" hide-details v-model="search" label="Cari Periode Laporan" variant="outlined"
                        append-inner-icon="mdi:mdi-magnify"></v-text-field>
                    <v-btn prepend-icon="mdi:mdi-plus" color="success" @click="showDialog(search)">
                        Cari
                    </v-btn>
                </div>
            </div>
        </v-card>
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
            showPassword: false,
            errors: {},
            aktivasiItem: [],
            form: {},
        };
    },
    computed:{
        filteredObject() {
            return this.form.Jumlah_Aktivasi.find((obj) => obj.bulan === 4);
        },
    },
    methods: {
        printLaporan() {
            let printContents = document.getElementById("laporanBulananId").innerHTML;
            let printWindow = window.open("", "_blank", "height=500,width=500");

            printWindow.document.write(
                "<html><head><title>Cetak Laporan Bulanan</title></head><body>"
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
            } else{
                return this.formattedCurrency(this.hitungJumlahDeposit(value))
            }
        },
        hitungJumlahDeposit(value){
            if(this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === value) && this.form.Jumlah_Deposit_Uang.some(obj => obj.bulan === value)){
               return parseInt(this.form.Jumlah_Deposit_Kelas.find((obj) => obj.bulan === value).jumlah_deposit_kelas) + parseInt(this.form.Jumlah_Deposit_Uang.find((obj) => obj.bulan === value).jumlah_deposit_uang)
            }else if(this.form.Jumlah_Deposit_Kelas.some(obj => obj.bulan === value)){
                return this.form.Jumlah_Deposit_Kelas.find((obj) => obj.bulan === value).jumlah_deposit_kelas
            }else{
                this.form.Jumlah_Deposit_Uang.find((obj) => obj.bulan === value).jumlah_deposit_uang
            }
        },
        formattedCurrency(value) {
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
            return formatter.format(value);
        },
        showDialog(value) {
            
            this.errors = {};
            UserService.getLaporanPendapatan(value).then((response) => {
                if (response.data.success) {
                    this.form = response.data.data;
                }
                this.dialog = true;
            },
            (error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data;
                    } else {
                        this.$store.dispatch("snackbar/showSnack", {
                            message: 'Laporan pendapatan perbulan tidak ditemukan!',
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
