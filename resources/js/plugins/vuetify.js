// Styles
import "vuetify/styles";

// Import
import { createVuetify } from "vuetify";
import * as labs from "vuetify/labs/components";

// Icons
import "@fortawesome/fontawesome-free/css/all.css";
import "@mdi/font/css/materialdesignicons.css";
import { aliases, fa } from "vuetify/iconsets/fa";
import { mdi } from "vuetify/iconsets/mdi";

const vuetify = createVuetify({
    components: {
        ...labs,
    },
    icons: {
        defaultSet: "fa",
        aliases,
        sets: {
            fa,
            mdi,
        },
    },
});

export default vuetify;
