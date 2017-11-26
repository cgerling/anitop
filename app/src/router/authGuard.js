import * as AuthService from '../services/authService'

export default function isLogged (to, from, next) {
  if (!AuthService.isLogged()) {
    next('/auth/login')
    return
  }

  next()
}
