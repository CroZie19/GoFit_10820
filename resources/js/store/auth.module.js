import AuthService from "../services/auth.service";

const user = JSON.parse(localStorage.getItem("user"));
const initialState = user
    ? { status: { loggedIn: true }, user }
    : { status: { loggedIn: false }, user: null };

export const auth = {
    namespaced: true,
    state: initialState,
    actions: {
        login({ commit }, user) {
            return AuthService.login(user).then(
                (response) => {
                    commit("loginSuccess", response);
                    return Promise.resolve(response);
                },
                (error) => {
                    commit("loginFailure");
                    return Promise.reject(error);
                }
            );
        },
        logout({ commit }) {
            return AuthService.logout().then(
                (response) => {
                    commit("logout");
                    return Promise.resolve(response);
                },
                (error) => {
                    return Promise.reject(error);
                }
            );
        },
    },
    mutations: {
        loginSuccess(state, user) {
            state.status.loggedIn = true;
            state.user = user;
        },
        loginFailure(state) {
            state.status.loggedIn = false;
            state.user = null;
        },
        logout(state) {
            state.status.loggedIn = false;
            state.user = null;
        },
    },
};
