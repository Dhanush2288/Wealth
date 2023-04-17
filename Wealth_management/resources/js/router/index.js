import { createRouter, createWebHistory } from "vue-router";

import adminIndex from "../components/pages/Admin/index.vue";
import Indexhome from "../components/pages/Admin/home.vue";
import Logincomponent from "../components/pages/login.vue";
import Registercomponent from "../components/pages/register.vue";
import ClientIndexhome from "../components/pages/Client/dashboard.vue";
import CreatorIndexhome from "../components/pages/Creator/dashboard.vue";
import Createblog from "../components/pages/Creator/create.vue";
import Profileblog from "../components/pages/Creator/profile.vue";
import Nav from "../components/pages/reuseable/nav.vue";
import Viewcreator from "../components/pages/Creator/viewcreator.vue";
import Editcreator from "../components/pages/Creator/edit.vue";
import viewallcreator from "../components/pages/Creator/viewallblogs.vue";
import Rmsprofile from "../components/pages/Creator/rmsprofile.vue";
import Rmsprofiletag from "../components/pages/Creator/rmprofilech.vue";

//RM stuff
import RmIndexhome from "../components/pages/Rm/dashboard.vue";
import RmIAssign from "../components/pages/Rm/Assign.vue";
import viewrm from "../components/pages/RM/viewrm.vue";
import MyRmProfile from "../components/pages/Rm/myrmprofile.vue";
import Oneclient from "../components/pages/Rm/Oneclient.vue";
import allClientProfile from "../components/pages/Rm/clientprofiles.vue";


import Clienthome from "../components/pages/client/dashboard.vue";
import viewclient from "../components/pages/client/create.vue";
import assigned from "../components/pages/client/assigned.vue";
import Profilesclient from "../components/pages/client/rmsprofile.vue";
import Pastassigned from "../components/pages/client/pastassigned.vue";

import myprofile from "../components/pages/client/myprofile.vue";

import rmmm from "../components/pages/client/rmprofilee.vue";

import NoAuth from "../components/pages/404.vue";

import store from "../store";

const routes = [
    {
        path: "/admin",
        component: adminIndex,
        meta: { requiresAuth: true, requiresAdmin: true },
    },
    {
        path: "/home",
        component: ClientIndexhome,
    },
    {
        path: "/manager",
        component: RmIndexhome,
        meta: { requiresAuth: true, requiresManager: true },
        name: "manager",
    },
    {
        path: "/creator",
        component: CreatorIndexhome,
        meta: { requiresAuth: true, requiresCreator: true },
        name: "creator",
    },
    {
        path: "/createblog",
        component: Createblog,
        meta: { requiresAuth: true, requiresCreator: true },
        name: "create_blog",
    },
    {
        path: "/creatorprofile",
        component: Profileblog,
        name: "creatorprofile",
    },
    {
        path: "/",
        redirect: "/login",
    },
    {
        path: "/login",
        component: Logincomponent,
        name: "Login",
    },
    {
        path: "/register",
        component: Registercomponent,
    },

    {
        path: "/notauth",
        component: NoAuth,
    },
    {
        path: "/view/:id",
        component: Viewcreator,
        name: "view",
    },
    {
        path: "/edit/:id",
        component: Editcreator,
        name: "edit",
    },
    {
        path: "/Rmprofile/:id",
        component: Rmsprofiletag,
        name: "Rmprofile",
    },
    {
        path: "/viewall",
        component: viewallcreator,
        name: "viewall",
    },
    {
        path: "/viewrm/:id",
        component: viewrm,
        name: "viewrm",
    },
    {
        path: "/ProfilesRm",
        component: Rmsprofile,
        name: "ProfilesRm",
    },{

        path:'/Assign',
        component: RmIAssign,
        name: "Assign",
    },
    {

        path:'/MyRmProfile',
        component: MyRmProfile,
        name: "MyRmProfile",
    },
    {

        path:'/ClientProfile/:id',
        component: Oneclient,
        name: "ClientProfile",
    },
    {

        path:'/allClientProfile',
        component: allClientProfile,
        name: "allClientProfile",
    },
    {

        path:'/client',
        component: Clienthome,
        name: "Client",
        meta: { requiresAuth: true, requiresClient: true },

    },
    {

        path:'/viewrmt/:id',
        component: rmmm,
        name: "viewrmt",
        meta: { requiresAuth: true, requiresClient: true },

    },
    {

        path:'/viewclient/:id',
        component: viewclient,
        name: "viewclient",

    },
    {
        path:'/viewassigned',
        component: assigned,
        name: "viewassigned",
        meta: { requiresAuth: true, requiresClient: true },

    },
    {
        path:'/pastassigned',
        component: Pastassigned,
        name: "pastassigned",
        meta: { requiresAuth: true, requiresClient: true },

    },
    {
        path:'/Profilesclient',
        component: Profilesclient,
        name: "Profilesclient",
        meta: { requiresAuth: true, requiresClient: true },

    }
    ,{
        path:'/clientprofile',
        component: myprofile,
        name: "clientprofile",
        meta: { requiresAuth: true, requiresClient: true },

    }

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
router.beforeEach(async (to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        const f = localStorage.getItem("user");
        const users = JSON.parse(f);

        console.log(users);

        // If the user is not authenticated, redirect to login page
        console.log(!f);
        if (!f) {
            next({ path: "/login" });
            return;
        }

        if (
            to.matched.some((record) => record.meta.requiresAdmin) &&
            users.usertype !== "Admin"
        ) {
            next({ path: "/notauth" });
            return;
        }
        if (
            to.matched.some((record) => record.meta.requiresCreator) &&
            users.usertype !== "Creator"
        ) {
            next({ path: "/notauth" });
            return;
        }
        if (
            to.matched.some((record) => record.meta.requiresClient) &&
            users.usertype !== "Client"
        ) {
            next({ path: "/notauth" });
            return;
        }
        if (
            to.matched.some((record) => record.meta.requiresManager) &&
            users.usertype !== "Manager"
        ) {
            next({ path: "/notauth" });
            return;
        }
    }
    next();
});

export default router;
