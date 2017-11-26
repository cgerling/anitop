import httpService from 'axios'

const storageTokenKey = 'USER_TOKEN'

function saveToken (token) {
  window.localStorage.setItem(storageTokenKey, JSON.stringify(token))
}

export function obtainToken () {
  return JSON.parse(window.localStorage.getItem(storageTokenKey))
}

export function login (email, password) {
  return httpService.post('http://localhost:3000/auth/login', {
    email,
    password
  }).then(({ data }) => {
    saveToken(data.token)
  })
}

export function logout () {
  saveToken(null)
}

export function register (name, email, password) {
  return httpService.post('http://localhost:3000/auth/register', {
    name,
    email,
    password
  })
}

export function isLogged () {
  return obtainToken() != null
}
