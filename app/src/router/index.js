import Vue from 'vue'
import Router from 'vue-router'

import Auth from '@/container/Auth'
import Home from '@/container/Home'
import Details from '@/container/Details'
import Watchlist from '@/container/Watchlist'
import Search from '@/container/Search'

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
      name: 'Início',
      component: Home,
      beforeEnter: AuthGuard
    },
    {
      path: '/anime/:id',
      name: 'Detalhes',
      component: Details,
      beforeEnter: AuthGuard
    },
    {
      path: '/watchlist',
      name: 'Assistindo',
      component: Watchlist,
      beforeEnter: AuthGuard
    },
    {
      path: '/search/:term',
      name: 'Resultado da Busca',
      component: Search,
      beforeEnter: AuthGuard
    }
  ]
})
