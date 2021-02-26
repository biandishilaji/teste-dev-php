import Vue from 'vue'
import Vuex from 'vuex'

import axios from 'axios'
import * as types from './mutation-types'

Vue.use(Vuex)

const state = {
  brands: []
}

const getters = {
  getListBrands: state => state.brands
}

const mutations = {
  [types.FETCH_LIST_BRANDS] (state, data) {
    state.brands = data.brands
  }
}

const actions = {

  fetchInitBrands ({commit}, params) {

    return axios.get('/brands', {params: params}).then(response => {

      return Promise.resolve(response)
    })
      .catch(error => {
        return Promise.reject(error)
      })
  },
  fetchListBrands ({commit}, params) {

    return axios.get('/brands/list').then(response => {

      commit(types.FETCH_LIST_BRANDS, response.data)

      return Promise.resolve(response)
    })
      .catch(error => {
        return Promise.reject(error)
      })
  },
  postCreateBrand ({commit}, params) {

    return axios.post('/brands', params).then(response => {

      commit(types.FETCH_LIST_BRANDS, response.data)

      return Promise.resolve(response)
    })
      .catch(error => {
        return Promise.reject(error)
      })

  },

}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
