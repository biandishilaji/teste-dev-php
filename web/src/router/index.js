import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'
import routes from './routes'
import {sync} from 'vuex-router-sync'

Vue.use(VueRouter)

const router = new VueRouter({
  scrollBehavior,
  routes,
  mode: 'history'
})

sync(store, router)

function scrollBehavior (to, from, savedPosition) {
  if (savedPosition) {
    return savedPosition
  }

  if (to.hash) {
    return {selector: to.hash}
  }

  const [component] = router.getMatchedComponents({...to}).slice(-1)

  if (component && component.scrollToTop === false) {
    return {}
  }

  return {x: 0, y: 0}
}

export default router
