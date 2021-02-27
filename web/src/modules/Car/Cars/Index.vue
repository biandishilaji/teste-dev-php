<template>

  <div>
    <div v-if="!this.ignore_default" class="">
      <SearchingDefaultBrands @ignoreDefaultBrands="handleIgnoreDefaultBrands"/>
    </div>
    <div>
      <transition name="fade">
        <div class="row" v-if="this.ignore_default">
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h4 class="text-center">Cadastre aqui <br>uma nova marca de carro</h4>
                <div class="input-group">
                  <a href="#" @click.prevent="handleNewBrand()" class="input-group-prepend">
												<span class="input-group-text"><i v-if="buttonIsLoadidng" class="icon-spinner2 spinner"></i>
                        <i class="icon-checkmark" v-else></i></span>
                  </a>
                  <input v-model="Brand.name" type="text" class="form-control text-uppercase"
                         placeholder="Digite o nome da marca">
                </div>
              </div>
            </div>
            <div v-if="skeletons.includes('card')" class="card">
              <div class="card-header bg-white header-elements-inline">
                <skeleton type="button" class="btn-block"/>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 opacity-75">
                    <skeleton type="text" class="btn-block"/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <skeleton type="text" class="btn-block"/>
                  </div>
                </div>
              </div>
            </div>
            <div v-else class="card">
              <div class="card-header bg-white ">
                <button @click="showModalCreateCar = true"
                        class="rounded btn border-slate-600 bg-default btn-block text-white">
                  <i class="fa fa-plus"></i> Novo carro
                </button>
              </div>

              <div class="card-body">
                <form @submit.prevent="handleFilterAdvancedSubmit()">
                  <div class="row">
                    <div class="col-12 opacity-75">
                      <div class="form-group">
                        <label>Modelo</label>
                        <input class="form-control" placeholder="Digite o modelo" v-model="filter.model">
                      </div>
                      <div class="form-group">
                        <label>Marca</label>
                        <select2 v-model="filter.brand_id">
                          <option value="" selected>Selecione</option>
                          <option v-for="item in brands" :value="item.id">{{ item.name }}</option>
                        </select2>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button type="submit" class="btn border-slate-600 btn-block bg-default btn-sm btn-icon"><i
                        class="fa fa-search"></i> Filtrar
                      </button>
                    </div>
                    <div class="col-6">
                      <a @click.prevent="handleEraseFilters" class="btn border-slate-600 btn-block btn-sm btn-icon"><i
                        class="fa fa-clear"></i> Limpar
                      </a>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="row" v-if="skeletons.includes('widgets')">
              <div class="col-4">
                <div class="card">
                  <div class="card-body">
                    <skeleton type="text"/>
                    <skeleton type="text"/>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card">
                  <div class="card-body">
                    <skeleton type="text"/>
                    <skeleton type="text"/>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card">
                  <div class="card-body">
                    <skeleton type="text"/>
                    <skeleton type="text"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" v-else>
              <div class="widgets">
                <div class="card">
                  <div class="card-body" id="card1">
                    TOTAL DE CARROS
                    <h4 class="text-green">{{ widgets.total || 0 }}</h4>
                  </div>
                </div>
              </div>
              <div class="widgets">
                <div class="card">
                  <div class="card-body" id="card2">
                    CADASTRADO RECENTEMENTE
                    <h4 class="text-green">{{ widgets.recently_created || 0 }}</h4>

                    <small v-if="removed > 0">REMOVIDOS: <span class="text-danger">{{ removed }}</span></small>

                  </div>
                </div>
              </div>
              <div class="widgets">
                <div class="card ">
                  <div class="card-body" id="card3">
                    MARCAS
                    <h4 class="text-green">{{ brands.length }}</h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card border-top-0">
                  <div class="card-body">
                    <list-car ref="listCar" :source="cars" :filters="filter"></list-car>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </transition>
    </div>

    <!--    v-if para recriar o componente-->
    <!--    v-show mantem as variaveis criadas.-->

    <modal-create-car :show.sync="showModalCreateCar"
                      v-if="showModalCreateCar"
                      @submitAndClose="handleSubmitAndCloseModalCreateCar()"
                      @close="showModalCreateCar = false"
    ></modal-create-car>
  </div>
</template>

<script>

let filters = {
  brand_id: '',
  model: ''
}
import Skeleton from '@/components/Common/Skeleton'
import SearchingDefaultBrands from '@/components/SearchingDefaultBrands'
import ListCar from './Shared/_ListCar'
import Select2 from '@/components/Select2'
import ModalCreateCar from './Shared/_ModalCreateCar'
import Swal from '@/plugins/swal'

import {mapGetters} from 'vuex'

export default {
  name: 'CarsIndex',
  components: {
    ListCar,
    Select2,
    ModalCreateCar,
    SearchingDefaultBrands,
    Skeleton
  },
  data () {
    return {
      showModalCreateCar: false,
      filter: filters,
      ignore_default: 0,
      show: false,
      skeletons: [],
      buttonIsLoadidng: false,
      Brand: {
        name: ''
      }
    }
  },
  computed: {
    ...mapGetters({
      'cars': 'cars/getListCars',
      'brands': 'brands/getListBrands',
      'widgets': 'cars/getWidgets',
      'removed': 'cars/countRemovedCars',
    })
  },
  watch: {
    cars: function () {
      console.log(this.cars, 'oi!')
    },
    ignore_default (val) {
      val && this.init()
    }
  },
  mounted () {
    // valida primeiro acesso do usuario
    if (!localStorage.getItem('first_access')) {
      localStorage.setItem('first_access', false)
    } else {
      this.ignore_default = true
    }
  },
  created () {
    // faz o vue dar um "watch" na listagem do plugin
    this.skeletons = this.$skel.getAll()
  },

  methods: {
    init () {

      this.$skel.add('list')
      this.$skel.add('widgets')
      this.$skel.add('card')

      this.$store.dispatch('cars/fetchInitCars').then(response => {

        this.$skel.remove('list')

      }).catch(error => {
        this.$skel.remove('list')

      })

      // consultas asincronas para melhor desempenho

      this.$store.dispatch('cars/fetchWidgets').then(response => {
        this.$skel.remove('widgets')
      }).catch(error => {
        this.$skel.remove('widgets')
      })

      this.$store.dispatch('brands/fetchListBrands').then(response => {
        this.$skel.remove('card')
      }).catch(error => {
        this.$skel.remove('card')
      })

    },
    handleEraseFilters () {
      for (var field in this.filter) {
        this.filter[field] = ''
      }
    },
    handleFilterAdvancedSubmit () {
      this.$refs.listCar.fetch()
    },
    handleSubmitAndCloseModalCreateCar () {
      this.showModalCreateCar = false
      this.init()
    },
    handleNewBrand () {
      this.buttonIsLoadidng = true

      if (!this.Brand.name) {
        this.buttonIsLoadidng = false
        Swal.warning('Informe o nome da marca para continuar.')
        return
      }

      let params = this.Brand

      this.$store.dispatch('brands/postCreateBrand', params).then(response => {

        this.buttonIsLoadidng = false

        this.Brand.name = ''

        Swal.success(response.message)
      }).catch(error => {

        this.buttonIsLoadidng = false

        Swal.error(error.message)

      })

    },
    handleIgnoreDefaultBrands () {
      this.ignore_default = 1
    }
  }
}
</script>

<style>
@media screen and (min-height: 768px) {
  .widgets {
    min-height: 190px;
    -ms-flex: 0 0 33%;
    flex: 0 0 33%;
    max-width: 33%;
  }
}

@media screen and (max-height: 920px) {
  .widgets {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: .625rem;
    padding-left: .625rem
  }
}

@media screen and (max-height: 768px) and (min-width: 1024px) {
  .widgets {
    -ms-flex: 0 0 33%;
    flex: 0 0 33%;
    max-width: 33%;
  }

  .widgets #card1, #card2, #card3 {
    min-height: 125px;
  }
}

</style>
