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
                email_member: member.email_member,
                alamat_member: member.alamat_member,
                nomor_telephone_member: member.nomor_telephone_member,
                tanggal_lahir: member.tanggal_lahir,
            },
            { headers: authHeader() }
        );
    }
    editMember(member) {
        return axios.put(
            `api/member/${member.id}`,
            {
                nama: member.nama_member,
                email: member.email_member,
                alamat: member.alamat_member,
                no_telp: member.nomor_telephone_member,
                tanggal_lahir: member.tanggal_lahir,
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
}

export default new UserService();
