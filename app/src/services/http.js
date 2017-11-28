import axios from 'axios'
import { obtainToken } from '../services/authService'

const baseURL = 'http://localhost:3000/'
const headers = {
  'Authorization': obtainToken() || ''
}

export function updateHeaders (instance, header, value) {
  headers[header] = value

  instance.defaults.headers = headers
}

export default axios.create({
  baseURL,
  headers
})
