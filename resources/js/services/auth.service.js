import axios from "axios";
import authHeader from "./auth-header";

class AuthService {
    login(user) {
        return axios
            .post("/api/login", {
                email: user.email,
                password: user.password,
                role: user.role,
            })
            .then((response) => {
                if (response.data.token) {
                    localStorage.setItem(
                        "user",
                        JSON.stringify(response.data.token)
                    );
                }
                return response.data;
            });
    }

    logout() {
        return axios
            .get("/api/logout", { headers: authHeader() })
            .then((response) => {
                if (response.data.success) {
                    localStorage.removeItem("user");
                }
                return response;
            });
    }
}

export default new AuthService();
