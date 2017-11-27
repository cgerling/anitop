import http from './http'

export function obtainAll (page = 1, size) {
  return http.get('/anime', {
    page,
    size
  })
}

export function obtain (id) {
  return http.get(`/anime/${id}`)
}
