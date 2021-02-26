import Vue from 'vue'
import Vuex from 'vuex'

import axios from 'axios'
import * as types from './mutation-types'

Vue.use(Vuex)

const state = {
  car: {},
  cars: [],
  brands: [],
  widgets: {},
  total_removed: 0
}

const getters = {
  getListCars: state => state.cars,
  getCar: state => state.car,
  getWidgets: state => state.widgets,
  countRemovedCars: state => state.total_removed,
}

const mutations = {
  [types.FETCH_CAR] (state, data) {
    state.car = data.car
  },
  [types.FETCH_INIT_CAR] (state, data) {
    state.cars = data.cars
  },
  [types.FETCH_LIST_CAR] (state, data) {
    state.cars = data.cars
  },
  [types.FETCH_WIDGETS] (state, data) {
    state.widgets = data.widgets
  }
}

const actions = {

  fetchInitCars ({commit}, params) {

    return axios.get('/cars', {params: params}).then(response => {

      commit(types.FETCH_INIT_CAR, response.data)

      return Promise.resolve(response)
    })
      .catch(error => {
        return Promise.reject(error)
      })

  },

  fetchListCars ({commit}, params) {

    return axios.get('/cars/list', {params: params}).then(response => {

      commit(types.FETCH_LIST_CAR, response.data)

      return Promise.resolve(response)
    })
      .catch(error => {
        return Promise.reject(error)
      })

  },

  fetchCar({commit}, params){
    return axios.get(`/cars/${params.id}`, params).then(response => {

      commit(types.FETCH_CAR, response.data)

      return Promise.resolve(response)
    })
      .catch(error => {
        return Promise.reject(error)
      })

  },
  fetchWidgets ({commit}, params) {

    return axios.get('/cars/widgets', {params: params}).then(response => {

      console.log({response})
      commit(types.FETCH_WIDGETS, response.data)

      return Promise.resolve(response)
    })
      .catch(error => {
        return Promise.reject(error)
      })

  },

  postCreateCar ({commit}, params) {

    return axios.post('/cars', params).then(response => {

      return Promise.resolve(response)
    })
      .catch(error => {
        return Promise.reject(error)
      })

  },

  postEditCar ({commit}, params) {

    return axios.put(`/cars/${params.id}`, params).then(response => {

      return Promise.resolve(response)
    })
      .catch(error => {
        return Promise.reject(error)
      })

  },

  fetchInitBrands ({commit}, params) {

    return axios.get('/cars/brands', {params: params}).then(response => {

      return Promise.resolve(response)
    })
      .catch(error => {
        return Promise.reject(error)
      })
  },

  deleteRemoveCar ({commit}, params) {

    console.log(params.Id)
    return axios.delete(`/cars/${params.Id}`).then(response => {

      return Promise.resolve(response)
    })
      .catch(error => {
        return Promise.reject(error)
      })
  }

}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
