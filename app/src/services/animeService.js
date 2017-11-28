import http from './http'

export function obtainAll (page = 1, size) {
  return http.get('/anime', {
    page,
    size
  })
}

export function obtain (anime) {
  return http.get(`/anime/${anime}`)
}

export function obtainPopularity (anime) {
  return http.get(`/anime/${anime}/popularity`)
}

export function watching (anime) {
  return http.get(`/watchlist/${anime}`)
}

export function obtainWatchlist () {
  return http.get('/watchlist')
}

export function addToWatchlist (anime) {
  return http.post('/watchlist', {
    anime
  })
}

export function removeFromWatchlist (anime) {
  return http.delete(`/watchlist/${anime}`)
}
