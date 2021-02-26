<template>
  <div>
    <div class="">
      <div class="form-group row">
        <div class="col-md-2 ml-md-auto">
          <select class="form-control form-control-sm" v-model="params.per_page"
                  @change.prevent="updateLimit()">
            <option value="1">1</option>
            <option value="5" selected>5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="250">250</option>
          </select>
        </div>
      </div>
    </div>

    <div class="">
      <div class="table table-bordered table-scrollable">
        <table class="table">
          <thead>
          <tr>
            <th class="text-center">Ação</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th class="text-nowrap">Motor</th>
            <th>Cor</th>
            <th class="text-nowrap">Ano</th>
            <th class="text-nowrap">Cadastrado em</th>
          </tr>
          </thead>
          <tbody>
          <tr v-if="skeletons.includes('list')" v-for="item in 5">
            <td colspan="12">
              <skeleton type="small"/>
            </td>
          </tr>
          <tr v-for="item in source.data">
            <th class="text-center">
              <div class="dropdown">
                <button class="btn bg-green-400 dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-cogs" style="color: blueviolet"></i> Selecione
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" @click.prevent="handleEditCar(item)" href="#"><i
                    class="icon-pencil5"></i>Editar</a>
                  <a class="dropdown-item" @click.prevent="handleRemoveCar(item)" href="#"><i class="icon-trash-alt"
                                                                                              style="color: crimson"></i>Remover</a>
                </div>
              </div>
            </th>
            <th>{{ item.brande_name }}</th>
            <th>{{ item.model }}</th>
            <th>{{ item.engine }}</th>
            <th>{{ item.color }}</th>
            <th class="text-center">{{ item.year_of_manufacture }}</th>
            <th class="text-nowrap">{{ moment(item.created_at).format('DD/MM/YYYY hh:mm:ss') }}</th>
          </tr>
          </tbody>
        </table>
      </div>
      <skeleton v-show="skeletons.includes('list')" class="mt-4" type="small"/>
      <pagination v-show="!skeletons.includes('list')" :source="source" @navegate="navegate"></pagination>
    </div>
    <modal-edit-car :show.sync="showModalEditCar"
                    @submitAndClose="handleSubmitAndCloseModalEdit"
                    @close="showModalEditCar = false"></modal-edit-car>
  </div>
</template>

<script>

import Skeleton from '@/components/Common/Skeleton'

const moment = require('moment')
import Pagination from '@/components/Common/Pagination'
import Swal from '@/plugins/swal'
import ModalEditCar from './_ModalEditCar'

export default {
  name: 'ListCar',
  components: {
    Skeleton,
    Pagination,
    ModalEditCar
  },
  props: ['filters', 'source'],
  data () {
    return {
      skeletons: [],
      moment: moment,
      params: {
        page: 1,
        per_page: 5
      },
      showModalEditCar: false
    }
  },
  created () {
    this.skeletons = this.$skel.getAll()
  },

  methods: {
    handleEditCar (item) {
     let loader = this.$loading.show()

      this.$store.dispatch('cars/fetchCar', item)
        .then(response => {
          loader.hide()
          this.showModalEditCar = true
        })
        .catch(error => {
          Swal.error(error.message)
          loader.hide()
        })
    },
    navegate (page) {
      this.params.page = page
      this.fetch()
    },
    handleSubmitAndCloseModalEdit () {
      this.showModalEditCar = false

      const stateCars = this.$store.state.cars.cars.data

      console.log(stateCars)

      stateCars.splice(stateCars.indexOf(this.selected), 1, this.selected)

      console.log(stateCars)
    },
    fetch () {
      this.params.filter = this.filters

      let loader = this.$loading.show()

      this.$store.dispatch('cars/fetchListCars', this.params)
        .then(response => {
          loader.hide()
        })
        .catch(error => {
          loader.hide()
        })
    },
    updateLimit () {
      this.fetch()
    },
    handleRemoveCar (item) {

      let loader = this.$loading.show()

      let params = {
        Id: item.id
      }

      let stateWidgets = this.$store.state.cars.widgets

      this.$store.dispatch('cars/deleteRemoveCar', params)
        .then(response => {
          // remove um  do total de carros
          stateWidgets.total -= 1
          this.$store.state.cars.total_removed += 1
          // atualiza a lista
          this.updateLimit()
          // esconde o loader
          loader.hide()
          // retorna mensagem
          Swal.success(response.message)
        })
        .catch(error => {
          loader.hide()
          Swal.error(error.message)
        })
    }
  }
}
</script>

<style scoped>

</style>
