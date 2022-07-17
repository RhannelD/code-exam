import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";

import axios from 'axios';
import Main from "./layouts/Main.vue"
import Signin from "./components/auth/Signin.vue";
import UserIndex from "./components/users/UserIndex.vue";
import RoleIndex from "./components/roles/RoleIndex.vue";

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
        meta: { 
            layout: Main,
            requiresAuth: true,
        },
    },
    {
        path: "/roles",
        name: "role.index",
        component: RoleIndex,
        meta: { 
            layout: Main,
            requiresAuth: true,
        },
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

router.beforeEach((to, from, next) => {
    if ( to.matched.some(record=>record.meta.requiresAuth) ) {
        axios.get('/api/user')
            .then((response) => {
                next();
            })
            .catch((error_data) => {
                if ( error_data.response.status===401 ) {
                    next({
                        name: 'signin'
                    });
                }
            });
    } else {
        next();
    }
});

export default router;