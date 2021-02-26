import './assets/css/icons/icomoon/styles.css'
import './assets/css/icons/fontawesome/styles.min.css'
import './assets/css/icons/material/icons.css'
import './assets/css/bootstrap.min.css'
import './assets/css/bootstrap_limitless.min.css'
import './assets/css/layout.min.css'
import './assets/css/components.css'
import './assets/css/colors.min.css'
import './assets/css/custom.css'

import 'bootstrap'
import Vue from 'vue'
import App from './App'
import * as skel from '@/plugins/skeleton'
import router from './router'
import store from './store'
import VueResource from 'vue-resource'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import VueTheMask from 'vue-the-mask'

Vue.use(VueResource)
Vue.use(VueTheMask)

import '@/plugins'

require('./assets/js/plugins/notifications/sweet_alert.min')
require('./assets/js/plugins/loaders/blockui.min.js')
require('./assets/js/plugins/ui/slinky.min.js')
require('./assets/js/app')

import MainLayout from './layouts/main'

Vue.component('main-layout', MainLayout)

Vue.prototype.$skel = skel

Vue.use(Loading, {color: '#5C6BC0', backgroundColor: '#000', loader: 'bars'});

const baseURL = process.env.API_URL

Vue.config.productionTip = false

const EventBus = new Vue({
  store,
  router,
  ...App
})

Object.defineProperties(Vue.prototype, {
  $bus: {
    get: function () {
      return EventBus
    }
  }
})
