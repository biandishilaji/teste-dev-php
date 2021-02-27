<template xmlns="http://www.w3.org/1999/html">
  <div>
    <div class="search mt-10 text-center">
      <section v-show="!valid_continue_with_error">
        <h2>Olá, sua primeira vez aqui? <br>aguarde um momento enquanto realizamos algumas ações</h2>
        <h5 style="color: black" v-show="stage == 0">criando ambiente de primeiro acesso. 1/2</h5>
        <h5 style="color: black" v-show="stage == 1">verificando se há marcas de carro pré definidas. 2/2.</h5>
        <img
          src="https://media-s3-us-east-1.ceros.com/forbes/images/2018/10/18/2462c44fdf4f248ef823b610a248809d/magnifyingglass2.gif?imageOpt=1">
      </section>
      <section v-if="valid_continue_with_error">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
<!--                <div class="alert bg-orange-300 text-white alert-dismissible">-->
<!--                  <span class="font-weight-semibold">Atenção!</span> <h6>Foi encontrado uma ação necessária e é desejável que você a corrija para continuar.</h6>-->
<!--                </div>-->
                <span  class="font-weight-semibold text-uppercase" style="font-weight: bold"><i class="icon-bubble-notification text-danger"/> {{ message }}</span>
                <br class="dashed">
                <button @click.prevent="handleIgnoreBrands" class="mt-2 btn btn-sm bg-danger-300">Ignorar e continuar
                </button>
                <p><small>não recomendado.</small></p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>

import Swal from '@/plugins/swal'

export default {
  name: "SearchingDefaultBrands",
  data() {
    return {
      stage: 0,
      valid_continue_with_error: false,
      message: ''
    }
  },
  mounted() {
    this.addStages()
  },
  methods: {
    async addStages() {
      const sleep = (ms) => {
        return new Promise(resolve => setTimeout(resolve, ms));
      }
      await sleep(2000);
      this.stage = 1
      await sleep(1000)
      this.$store.dispatch('brands/fetchInitBrands').then(response => {
        this.handleIgnoreBrands()
      }).catch(error => {
       this.message = error.message.includes('undefined') ? "Não foi possível se conectar com a Api. Verifique se o process.env.API_URL está definido corretamente." : error.message
        this.valid_continue_with_error = true
      })
    },
    handleIgnoreBrands() {
      this.$emit('ignoreDefaultBrands')
    }
  }
}
</script>

