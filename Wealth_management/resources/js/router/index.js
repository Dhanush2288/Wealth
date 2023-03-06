import { createRouter, createWebHistory } from "vue-router";

import adminIndex from '../components/pages/Admin/index.vue'
import Indexhome from '../components/pages/Admin/home.vue'
import Logincomponent from '../components/pages/login.vue'
import Registercomponent from '../components/pages/register.vue'
import ClientIndexhome from '../components/pages/Client/dashboard.vue'
import RmIndexhome from '../components/pages/Rm/dashboard.vue'
import CreatorIndexhome from '../components/pages/Creator/dashboard.vue'

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
        meta: { requiresAuth: true, requiresClient: true }

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
        component:Registercomponent
    }
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

    if (to.matched.some(record => record.meta.requiresAdmin) && users.usertype !== 'admin') {
      next({ path: '/notauth' })
      return
    }
    if (to.matched.some(record => record.meta.requiresCreator) && users.usertype !== 'creator') {
      next({ path: '/notauth' })
      return
    }
    if (to.matched.some(record => record.meta.requiresClient) && users.usertype !== 'client') {
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
