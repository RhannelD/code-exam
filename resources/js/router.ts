import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";

import Main from "./layouts/Main.vue"
import Signin from "./components/auth/Signin.vue";
import UserIndex from "./components/users/UserIndex.vue";

const routes: Array<RouteRecordRaw> = [
    {
        path: "/",
        name: "signin",
        component: Signin,
    },
    {
        path: "/users",
        name: "user.index",
        component: UserIndex,
        meta: { layout: Main },
    },
    {
        path: "/roles",
        name: "role.index",
        component: UserIndex,
        meta: { layout: Main },
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;