import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/Home'
import New from '@/pages/New'
import Tags from '@/pages/Tags'
import Tag from '@/pages/Tag'
import User from '@/pages/User'

Vue.use(Router);

export default new Router({
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
      path: '/new',
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
    }
  ]
})
