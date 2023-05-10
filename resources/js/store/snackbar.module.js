export const snackbar = {
    namespaced: true,
    state: {
        snackbar: { active: false, color: "", message: "", timer: 2000 },
    },
    actions: {
        showSnack({ commit }, { message, color, timer }) {
            commit("UPDATE_SNACKBAR", {
                active: true,
                color: color,
                message: message,
                timer: timer,
            });
        },
    },
    mutations: {
        UPDATE_SNACKBAR(state, snackbar) {
            state.snackbar = snackbar;
        },
    },
};
