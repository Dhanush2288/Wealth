import { createRouter, createWebHistory } from "vue-router";

import adminIndex from '../components/pages/Admin/index.vue'
import Indexhome from '../components/pages/Admin/home.vue'
import Logincomponent from '../components/pages/login.vue'
import Registercomponent from '../components/pages/register.vue'
import ClientIndexhome from '../components/pages/Client/dashboard.vue'
import CreatorIndexhome from '../components/pages/Creator/dashboard.vue'
import Createblog from '../components/pages/Creator/create.vue'
import Profileblog from '../components/pages/Creator/profile.vue'
import Nav from '../components/pages/reuseable/nav.vue'
import Viewcreator from '../components/pages/Creator/viewcreator.vue'
import Editcreator from '../components/pages/Creator/edit.vue'
import viewallcreator from '../components/pages/Creator/viewallblogs.vue'
import Rmsprofile from '../components/pages/Creator/rmsprofile.vue'
import Rmsprofiletag from '../components/pages/Creator/rmprofilech.vue'

//RM stuff
import RmIndexhome from '../components/pages/Rm/dashboard.vue'
import viewrm from '../components/pages/RM/viewrm.vue'

import NoAuth from '../components/pages/404.vue'

import store from '../store'

const routes =[
    {
        path:'/admin',
        component:adminIndex,
        meta: { requiresAuth: true, requiresAdmin: true }

    },
    {
        path:'/home',
        component:ClientIndexhome,

    },
    {
        path:'/manager',
        component:RmIndexhome,
        meta: { requiresAuth: true, requiresManager: true },
        name:'manager'

    },
    {
        path:'/creator',
        component:CreatorIndexhome,
        meta: { requiresAuth: true, requiresCreator: true },
        name:'creator'
    },
    {
        path:'/createblog',
        component:Createblog,
        meta: { requiresAuth: true, requiresCreator: true },
        name:'create_blog'
    },
    {
        path:'/creatorprofile',
        component:Profileblog,
        name:'creatorprofile'
    },
    {
        path:'/',
        redirect: '/login'
    },
    {
        path:'/login',
        component:Logincomponent,
        name: 'Login'
    },
    {
        path:'/register',
        component:Registercomponent
    },
    {
        path:'/dashboard',
        component:Registercomponent
    },
    {
        path:'/notauth',
        component:NoAuth
    },{
        path:'/view/:id',
        component:Viewcreator
    },
    {
        path:'/edit/:id',
        component:Editcreator
    },
    {
        path:'/Rmprofile/:id',
        component:Rmsprofiletag
    },
    {
        path:'/viewall',
        component:viewallcreator
    },{
        path:'/viewrm/:id',
        component:viewrm
    },
    {
        path:'/ProfilesRm',
        component:Rmsprofile
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})
router.beforeEach(async(to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    const f = localStorage.getItem('user');
    const users = JSON.parse(f);

    console.log(users);

    // If the user is not authenticated, redirect to login page
    console.log(!f);
    if (!f) {
      next({ path: '/login' })
      return
    }

    if (to.matched.some(record => record.meta.requiresAdmin) && users.usertype !== 'Admin') {
      next({ path: '/notauth' })
      return
    }
    if (to.matched.some(record => record.meta.requiresCreator) && users.usertype !== 'Creator') {
      next({ path: '/notauth' })
      return
    }
    if (to.matched.some(record => record.meta.requiresClient) && users.usertype !== 'Client') {
      next({ path: '/notauth' })
      return
    }
    if (to.matched.some(record => record.meta.requiresManager) && users.usertype !== 'Manager') {
      next({ path: '/notauth' })
      return
    }
  }
  next()
  })


export default router
