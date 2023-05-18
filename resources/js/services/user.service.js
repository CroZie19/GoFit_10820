import axios from "axios";
import authHeader from "./auth-header";

class UserService {
    getMenu() {
        return axios.get("api/menu", { headers: authHeader() });
    }
    getUserData() {
        return axios.get("api/profile", { headers: authHeader() });
    }
    getMember(id) {
        return axios.get(`api/member/${id}`, { headers: authHeader() });
    }
    getMemberList() {
        return axios.get("api/member", { headers: authHeader() });
    }
    addMember(member) {
        return axios.post(
            "api/member",
            {
                nama_member: member.nama_member,
                email: member.email,
                alamat_member: member.alamat_member,
                noTelp_member: member.noTelp_member,
                tanggal_lahir_member: member.tanggal_lahir_member,
                id_pegawai: member.id_pegawai,
            },
            { headers: authHeader() }
        );
    }
    editMember(member) {
        return axios.put(
            `api/member/${member.id}`,
            {
                nama_member: member.nama_member,
                email: member.email,
                alamat_member: member.alamat_member,
                noTelp_member: member.noTelp_member,
                tanggal_lahir_member: member.tanggal_lahir_member,
                tanggal_kardaluasa_member: member.tanggal_kardaluasa_member,
            },
            { headers: authHeader() }
        );
    }
    deleteMember(id) {
        return axios.delete(`api/member/${id}`, { headers: authHeader() });
    }
    resetPasswordMember(id) {
        return axios.put(`api/member/reset-sandi/${id}`, null, {
            headers: authHeader(),
        });
    }

    getInstruktur(id) {
        return axios.get(`api/instruktur/${id}`, { headers: authHeader() });
    }
    getInstrukturList() {
        return axios.get("api/instruktur", { headers: authHeader() });
    }

    addInstruktur(instruktur) {
        return axios.post(
            "api/instruktur",
            {
                nama_instruktur: instruktur.nama_instruktur,
                username_instruktur: instruktur.username_instruktur,
                password_instruktur: instruktur.password_instruktur,
                alamat_instruktur: instruktur.alamat_instruktur,
                noTelp_instruktur: instruktur.noTelp_instruktur,
                tanggal_lahir_instruktur: instruktur.tanggal_lahir_instruktur,
            },
            { headers: authHeader() }
        );
    }
    editInstruktur(instruktur) {
        return axios.put(
            `api/instruktur/${instruktur.id}`,
            {
                nama: instruktur.nama,
                email: instruktur.email,
                kata_sandi: instruktur.kata_sandi,
                alamat: instruktur.alamat,
                no_telp: instruktur.no_telp,
            },
            { headers: authHeader() }
        );
    }
    deleteInstruktur(id) {
        return axios.delete(`api/instruktur/${id}`, { headers: authHeader() });
    }

    getJadwalHarian(id) {
        return axios.get(`api/jadwal-harian/${id}`, { headers: authHeader() });
    }

    getJadwalHarianList() {
        return axios.get("api/jadwal-harian", { headers: authHeader() });
    }
    addJadwalHarian(instruktur) {
        return axios.post(
            "api/jadwal-harian",
            {
                id_kelas: jadwalHarian.id_kelas,
                id_instruktur: jadwalHarian.id_instruktur,
                status_kelas_harian: jadwalHarian.status_kelas_harian,
                tanggal_kelas_harian: jadwalHarian.tanggal_kelas_harian,
            },
            { headers: authHeader() }
        );
    }
    editJadwalHarian(jadwalHarian) {
        return axios.put(
            `api/jadwal-harian/${jadwalHarian.id}`,
            {
                id_kelas: jadwalHarian.id_kelas,
                id_instruktur: jadwalHarian.id_instruktur,
                status_kelas_harian: jadwalHarian.status_kelas_harian,
                tanggal_kelas_harian: jadwalHarian.tanggal_kelas_harian,
            },
            { headers: authHeader() }
        );
    }
    deleteJadwalHarian(id) {
        return axios.delete(`api/jadwal-harian/${id}`, {
            headers: authHeader(),
        });
    }
    getPerijinan(id) {
        return axios.get(`api/perijinanInstruktur/${id}`, {
            headers: authHeader(),
        });
    }

    getPerijinanList() {
        return axios.get("api/perijinanInstruktur", { headers: authHeader() });
    }
    addPerijinan(perijinan) {
        return axios.post(
            "api/perijinanInstruktur",
            {
                id_kelas: perijinan.id_kelas,
                id_jadwal_harian: perijinan.id_jadwal_harian,
                id_instruktur: perijinan.id_instruktur,
                status_kelas_harian: perijinan.status_kelas_harian,
                tanggal_kelas_harian: perijinan.tanggal_kelas_harian,
            },
            { headers: authHeader() }
        );
    }
    editPerijinan(perijinan) {
        return axios.put(
            `api/perijinanInstruktur/${perijinan.id}`,
            {
                id_kelas: perijinan.id_kelas,
                id: perijinan.id,
                id_instruktur: perijinan.id_instruktur,
                id_jadwal_harian: perijinan.id_jadwal_harian,
                status_kelas_harian: perijinan.status_kelas_harian,
                tanggal_kelas_harian: perijinan.tanggal_kelas_harian,
            },
            { headers: authHeader() }
        );
    }
    deletePerijinan(id) {
        return axios.delete(`api/perijinanInstruktur/${id}`, {
            headers: authHeader(),
        });
    }
    getAktivasi(id) {
        return axios.get(`api/aktivasi/${id}`, { headers: authHeader() });
    }
    getAktivasiList() {
        return axios.get("api/aktivasi", { headers: authHeader() });
    }
    addAktivasi(aktivasi) {
        return axios.post(
            "api/aktivasi",
            {
                nama_member: aktivasi.nama_member,
                email: aktivasi.email,
                alamat_member: aktivasi.alamat_member,
                noTelp_member: aktivasi.noTelp_member,
                tanggal_lahir_member: aktivasi.tanggal_lahir_member,
                id_pegawai: aktivasi.id_pegawai,
            },
            { headers: authHeader() }
        );
    }
    editAktivasi(aktivasi) {
        return axios.put(
            `api/aktivasi/${aktivasi.id}`,
            {
                id_pegawai: aktivasi.id_pegawai,
                id_member: aktivasi.id_member,
                metode_pembayaran_aktivasi: aktivasi.metode_pembayaran_aktivasi,
                status_member: aktivasi.status_member,
                tanggal_transaksi_aktivasi: aktivasi.tanggal_transaksi_aktivasi,
                tanggal_kardaluasa_member: aktivasi.tanggal_kardaluasa_member,
            },
            { headers: authHeader() }
        );
    }

    getBookingGym(id_booking_gym) {
        return axios.get(`api/bookingGym/${id_booking_gym}`, {
            headers: authHeader(),
        });
    }

    getBookingGymList() {
        return axios.get("api/bookingGym", { headers: authHeader() });
    }
    addBookingGym(bookingGym) {
        return axios.post(
            "api/bookingGym",
            {
                id_kelas: bookingGym.id_kelas,
                id_jadwal_harian: bookingGym.id_jadwal_harian,
                id_instruktur: bookingGym.id_instruktur,
                status_kelas_harian: bookingGym.status_kelas_harian,
                tanggal_kelas_harian: bookingGym.tanggal_kelas_harian,
            },
            { headers: authHeader() }
        );
    }
    editBookingGym(bookingGym) {
        return axios.put(
            `api/bookingGym/${bookingGym.id_booking_gym}`,
            {
                id_pegawai: bookingGym.id_pegawai,
                id_member: bookingGym.id_member,
                sesi_gym: bookingGym.sesi_gym,
                id_jadwal_harian: bookingGym.id_jadwal_harian,
                jumlah_kapasitas_gym: bookingGym.jumlah_kapasitas_gym,
                tanggal_booking_gym: bookingGym.tanggal_booking_gym,
            },
            { headers: authHeader() }
        );
    }
    deleteBookingGym(id) {
        return axios.delete(`api/bookingKelas/${id}`, {
            headers: authHeader(),
        });
    }

    getBookingKelas(id_booking_kelas) {
        return axios.get(`api/bookingKelas/${id_booking_kelas}`, {
            headers: authHeader(),
        });
    }

    getBookingKelasList() {
        return axios.get("api/bookingKelas", { headers: authHeader() });
    }
    addBookingKelas(bookingKelas) {
        return axios.post(
            "api/bookingKelas",
            {
                id_member: bookingKelas.id_member,
                id_kelas: bookingKelas.id_kelas,
                id_instruktur: bookingKelas.id_instruktur,
                id_transaksi_deposit_kelas: bookingKelas.id_transaksi_deposit_kelas,
                id_transaksi_deposit_uang: bookingKelas.id_transaksi_deposit_uang,
                sesi_kelas: bookingKelas.sesi_kelas,
                tanggal_booking_kelas: bookingKelas.tanggal_booking_kelas,
            },
            { headers: authHeader() }
        );
    }
    editBookingKelas(bookingKelas) {
        return axios.put(
            `api/bookingKelas/${bookingKelas.id_booking_kelas}`,
            {
                id_member: bookingKelas.id_member,
                id_kelas: bookingKelas.id_kelas,
                id_instruktur: bookingKelas.id_instruktur,
                id_transaksi_deposit_kelas: bookingKelas.id_transaksi_deposit_kelas,
                id_transaksi_deposit_uang: bookingKelas.id_transaksi_deposit_uang,
                sesi_kelas: bookingKelas.sesi_kelas,
                tanggal_booking_kelas: bookingKelas.tanggal_booking_kelas, 
            },
            { headers: authHeader() }
        );
    }
    deleteBookingKelas(id) {
        return axios.delete(`api/bookingKelas/${id}`, {
            headers: authHeader(),
        });
    }
}

export default new UserService();
