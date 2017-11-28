import http, { updateHeaders } from './http'

const storageTokenKey = 'USER_TOKEN'

function updateAuhorization () {
  const token = obtainToken()

  updateHeaders(http, 'Authorization', token)
}

function saveToken (token) {
  window.localStorage.setItem(storageTokenKey, JSON.stringify(token))
}

export function obtainToken () {
  return JSON.parse(window.localStorage.getItem('USER_TOKEN'))
}

export function login (email, password) {
  return http.post('/auth/login', {
    email,
    password
  }).then(({ data }) => {
    saveToken(data.token)
    updateAuhorization()
  })
}

export function logout () {
  saveToken(null)
}

export function register (name, email, password) {
  return http.post('/auth/register', {
    name,
    email,
    password
  })
}

export function isLogged () {
  return obtainToken() != null
}
