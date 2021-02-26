<template>
  <modal :show="show" @close="close" size="modal-md">
    <div slot="header">
      <h1>Cadastrar novo carro</h1>
    </div>
    <div slot="body" v-if="car">
      <div class="card-body">
        <form action="#">
          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <label>Marca</label>
                <select2 class="form-control form-control-sm" v-model="car.brand_id">
                  <option selected value="">Selecione</option>
                  <option v-for="car in brands" :value="car.id">{{ car.name }}</option>
                </select2>
                <small>Campo obrigatório</small>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <label>Modelo</label>
                <input v-model="car.model" type="text" class="form-control " placeholder="Modelo">
                <small>Campo obrigatório</small>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Motor</label>
                <input v-model="car.engine" v-mask="'#.#'" maxlength="2" type="text" placeholder="Cilindradas"
                       class=" form-control">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Ano de fabricação</label>
                <input v-model="car.year_of_manufacture" v-mask="'####'" maxlength="4" type="text"
                       class=" form-control"
                       placeholder="Fabricação">
                <small>Campo obrigatório</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Cor</label>
                <input v-model="car.color" type="text" placeholder="Cor predominante"
                       class=" form-control">
              </div>
            </div>
          </div>
          <div class="text-right">
            <button type="button" class="btn" @click="close">Fechar</button>
            <button type="submit" class="btn bg-default" @click.prevent="handleSubmitAndClose">Salvar
              e Fechar
            </button>
          </div>
        </form>
      </div>
    </div>
    <div slot="footer">
    </div>
  </modal>
</template>

<script>

import Modal from '@/components/Modal'
import Select2 from '@/components/Select2'
import Swal from '@/plugins/swal'
import {mapGetters} from 'vuex'

const moment = require('moment')

export default {
  name: 'ModalEditCar',
  components: {
    Modal,
    Select2
  },
  props: ['show'],
  computed: {
    ...mapGetters({
      'brands': 'brands/getListBrands',
    })
  },
  data () {
    return {
      required: [
        'brand_id',
        'model',
        'year_of_manufacture'
      ],
      moment: moment,
      car: null
    }
  },
  updated () {
    this.car = this.$store.state.cars.car
  },
  methods: {
    close () {
      this.$emit('close')
    },
    handleSubmitAndClose () {

      let params = this.car

      // 1886 primeiro carro do mundo

      if (this.car.year_of_manufacture < 1886) {
        Swal.warning('O ano de fabricação não é inválido. O primeiro carro do mundo foi inventado apenas em 1886. ')
        return
      }

      if (this.car.year_of_manufacture > this.moment().format('YYYY')) {
        Swal.warning('O ano de fabricação nao pode ser maior do que o ano atual.')
        return
      }

      let loader = this.$loading.show()

      this.$store.dispatch('cars/postEditCar', params).then(response => {

        Swal.success(response.message)

        this.$emit('submitAndClose')

        loader.hide()

      }).catch(error => {
        Swal.error(error.message)
        loader.hide()

      })
    }
  }
}
</script>
