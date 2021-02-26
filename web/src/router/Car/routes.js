import CarsModule from '@/modules/Car/Module'
import CarIndex from '@/modules/Car/Cars/Index'

export default [
  {
    path: '/car',
    component: CarsModule,
    meta: {
      module: 'Car'
    },
    children: [
      {
        path: '/',
        name: 'car.index',
        component: CarIndex
      }
    ]
  }
]
