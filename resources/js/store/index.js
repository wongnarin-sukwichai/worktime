import { createStore } from "vuex";
import user from "./modules/user";
import checkin from "./modules/checkin";
import upload from "./modules/upload";
import report from "./modules/report";
import edit from "./modules/edit";
import add from "./modules/add";

const store = createStore({
    modules:{
        user,
        checkin,
        upload,
        report,
        edit,
        add
    }
})

export default store