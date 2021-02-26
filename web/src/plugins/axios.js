import axios from 'axios'
import router from '@/router'
import store from '@/store'

let qs = require('qs')

const baseURL = process.env.API_URL

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.baseURL = baseURL

axios.defaults.paramsSerializer = params => {
  return qs.stringify(params, {arrayFormat: 'brackets'});
};

// Response interceptor
axios.interceptors.response.use(
  response => {
    console.log(response)
    return response.data.status == 'success' ? Promise.resolve(response.data) : Promise.reject(response.data)
  },
  error => {

    switch (error.response.status) {

      case 404:
        router.push({name: '404'})
        break;

    }

    return Promise.reject(error)

  });
