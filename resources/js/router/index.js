import { createRouter, createWebHistory } from "vue-router";

import Welcome from "../components/Welcome.vue";
import Checkout from "../components/Checkout.vue";
// import Login from "../components/Login.vue";
// import Home from "../components/Home.vue";
// import Dashboard from "../components/Dashboard.vue";
// import Editin from "../components/Editin.vue";
// import Editout from "../components/Editout.vue";
// import Member from "../components/Member.vue";
// import Addin from "../components/AddIn.vue";
// import Addout from "../components/AddIOut.vue";
// import Record from "../components/Record.vue";

import store from "../store";

const routes = [
    {
        path: "/",
        name: "welcome",
        component: Welcome,
    },
    {
        path: "/checkout",
        name: "checkout",
        component: Checkout,
    },
    // // {
    // //     path: "/login",
    // //     name: "login",
    // //     component: Login,
    // //     meta: {
    // //         guard: "guest",
    // //     },
    // // },
    // // {
    // //     path: "/home",
    // //     name: "home",
    // //     component: Home,
    // //     redirect: {
    // //         name: "dashboard",
    // //     },
    // //     meta: {
    // //         guard: "auth",
    // //     },
    // //     children: [
    // //     {
    // //         path: "/dashboard",
    // //         name: "dashboard",
    // //         component: Dashboard,
    // //         meta: {
    // //             guard: "auth"
    // //         }
    // //     },
    // //     {
    // //         path: "/editin/:id",
    // //         name: "editin",
    // //         component: Editin,
    // //         meta: {
    // //             guard: "auth"
    // //         }
    // //     },
    // //     {
    // //         path: "/editout/:id",
    // //         name: "editout",
    // //         component: Editout,
    // //         meta: {
    // //             guard: "auth"
    // //         }
    // //     },
    // //     {
    // //         path: "/member",
    // //         name: "member",
    // //         component: Member,
    // //         meta: {
    // //             guard: "auth"
    // //         }
    // //     },
    // //     {
    // //         path: "/addin/:uid/:dat",
    // //         name: "addin",
    // //         component: Addin,
    // //         meta: {
    // //             guard: "auth"
    // //         }
    // //     },
    // //     {
    // //         path: "/addout/:uid/:dat",
    // //         name: "addtout",
    // //         component: Addout,
    // //         meta: {
    // //             guard: "auth"
    // //         }
    // //     },
    // //     {
    // //         path: "/record",
    // //         name: "record",
    // //         component: Record,
    // //         meta: {
    // //             guard: "auth"
    // //         }
    // //     },
    // // ],
    // },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (store.getters.user) {
        if (to.matched.some((route) => route.meta.guard === "guest"))
            next({ name: "home" });
        else next();
    } else {
        if (to.matched.some((route) => route.meta.guard === "auth"))
            next({ name: "login" });
        else next();
    }
});

export default router;
