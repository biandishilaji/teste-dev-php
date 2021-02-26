import Vue from 'vue'
import Vuex from 'vuex'

import cars from './modules/car/cars'
import brands from './modules/car/brands'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    'cars': cars,
    'brands': brands,
  }
})
