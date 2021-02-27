<template>
  <modal class="table-scrollable modal-mask" :show="show" @close="close" size="modal-md">
    <div slot="header">
      <h1>Cadastrar novo carro</h1>
    </div>
    <div slot="body">
      <div class="card-body">
        <form action="#">
          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <label>Marca</label>
                <select2 class="form-control form-control-sm" v-model="Car.brand_id">
                  <option selected value="">Selecione</option>
                  <option v-for="item in brands" :value="item.id">{{ item.name }}</option>
                </select2>
                <small>Campo obrigatório</small>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <label>Modelo</label>
                <input v-model="Car.model" type="text" class="form-control " placeholder="Modelo">
                <small>Campo obrigatório</small>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Motor</label>
                <input v-model="Car.engine" v-mask="'#.#'" maxlength="2" type="text" placeholder="Cilindradas"
                       class=" form-control">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Ano de fabricação</label>
                <input v-model="Car.year_of_manufacture" v-mask="'####'" maxlength="4" type="text" class=" form-control"
                       placeholder="Informe o ano">
                <small>Campo obrigatório</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Cor</label>
                <input v-model="Car.color" type="text" placeholder="Cor predominante" class=" form-control">
              </div>
            </div>
          </div>


          <div class="text-right">
            <button type="button" class="btn" @click="close">Fechar</button>
            <button type="submit" class="btn bg-default" style="opacity: 70%;pointer-events: none" v-if="!allowSave">
              Salvar e Fechar
            </button>
            <button type="submit" class="btn bg-default" @click.prevent="handleSubmitAndClose" v-if="allowSave">Salvar
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

export default {
  name: 'ModalCreateCar',
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
      Car: {
        model: '',
        brand_id: '',
        price: '',
        year_of_manufacture: '',
        color: '',
        engine: ''
      },
      required: [
        'brand_id',
        'model',
        'year_of_manufacture'
      ],
      allowSave: false,
    }
  },
  updated () {

    if (this.Car) {

      let ready = true

      for (var item in this.Car) {
        if (this.required.includes(item)) {
          if (!this.Car[item]) {
            ready = false
          }
        }
      }
      ready ? this.allowSave = true : this.allowSave = false
    }

  },
  methods: {
    close () {
      this.$emit('close')
    },
    handleSubmitAndClose () {

      let params = this.Car

      // 1886 primeiro carro do mundo

      if (this.Car.year_of_manufacture < 1886) {
        Swal.warning('O ano de fabricação não é inválido. O primeiro carro do mundo foi inventado apenas em 1886. ')
        return
      }

      let loader = this.$loading.show()

      this.$store.dispatch('cars/postCreateCar', params).then(response => {

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
<style>
</style>
