import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/Home'
import New from '@/pages/New'
import Tags from '@/pages/Tags'
import Tag from '@/pages/Tag'
import User from '@/pages/User'
import Login from '@/pages/Auth/LoginForm'

import { store } from './../store';
import VueCookie from 'vue-cookie';

Vue.use(VueCookie);
Vue.use(Router);

const router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      redirect: {
        name: 'home'
      }
    },

    {
      path: '/home',
      name: 'home',
      component: Home
    },

    {
      path: '/new/:id',
      name: 'new',
      component: New
    },

    {
      path: '/tags',
      name: 'tags',
      component: Tags
    },

    {
      path: '/tag/:id/show',
      name: 'tag',
      component: Tag
    },

    {
      path: '/user/:id',
      name: 'user',
      component: User
    },

    {
      path: '/auth/signIn',
      name: 'auth.signIn',
      component: Login,
      meta: {
        middleware: [
          'guest'
        ],

      }
    }
  ]
});

export default router