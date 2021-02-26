import NotFound from '@/modules/Common/404'
import Forbideen from '@/modules/Common/403'
import Home from '@/modules/Common/home'

export default [
  {
    path: '*',
    redirect: '404'
  },
  {
    path: '/404',
    name: 'common.404',
    component: NotFound,
    meta: {
      layout: null
    },
  },
  {
    path: '/403',
    name: 'common.403',
    component: Forbideen,
    meta: {
      module: 'smartMcr'
    },
  },
  {
    path: '/home',
    name: 'smartmcr.home',
    component: Home,
    meta: {
      module: 'smartMcr'
    },
  }
]
