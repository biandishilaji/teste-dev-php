<template>
    <div id="app">
        <component :is="layout">
            <router-view/>
        </component>
    </div>
</template>

<script>

  const default_layout = 'main-layout'

  export default {
    el: '#app',
    components: {
    },
    data () {
      return {
        showModal: false,
      }
    },
    computed: {
      layout () {
        return (this.$route.meta.layout || default_layout)
      }
    }
  }
</script>

<style>
body,
input,
button,
textarea {
  font: 500 1.6rem Poppins;
  color: #6a6180;
  font-weight: bold;
}
body {
  font-size: 75%;
  /*zoom: 0.90;*/
}
.fade-enter-active, .fade-leave-active {
  transition: opacity 1.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
