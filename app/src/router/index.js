import Vue from 'vue'
import Router from 'vue-router'

import Auth from '@/container/Auth'
import Home from '@/container/Home'
import Details from '@/container/Details'
import Watchlist from '@/container/Watchlist'

import Login from '@/components/Login'
import Register from '@/components/Register'

import AuthGuard from './authGuard'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      redirect: '/home'
    },
    {
      path: '/auth',
      name: 'Auth',
      component: Auth,
      children: [
        {
          path: 'login',
          component: Login
        },
        {
          path: 'register',
          component: Register
        }
      ]
    },
    {
      path: '/home',
      component: Home,
      beforeEnter: AuthGuard
    },
    {
      path: '/anime/:id',
      component: Details,
      beforeEnter: AuthGuard
    },
    {
      path: '/watchlist',
      component: Watchlist,
      beforeEnter: AuthGuard
    }
  ]
})
