<template>
  <transition name="modal">
    <div>
      <div v-show="show" :class="{'modal-mask': true, modal: true,fade: true, 'modal-open': true, 'show': show}"
           style="display: block"
           tabindex="-1" role="dialog" aria-hidden="true">
        <div :class="`modal-dialog modal-dialog-centered ` + size" role="document">
          <div class="modal-content">
            <div class="modal-header bg-default" v-if="hasSlotHeader">
              <slot name="header"></slot>
              <button type="button" class="close" data-dismiss="modal" @click="close()">×</button>
            </div>
            <div class="modal-body">
              <slot name="body"></slot>
            </div>
            <div class="modal-footer">
              <slot name="footer"></slot>
            </div>
          </div>
        </div>
      </div>
      <slot name="modals"></slot>
    </div>
  </transition>
</template>

<script>
export default {
  name: 'Modal',
  props: ['show', 'size'],
  computed: {
    hasSlotHeader() {
      return this.$slots.header
    }
  },
  watch: {
    show(value) {
      if (value) {
        $('body').addClass('modal-open')
        $('body').append('<div class="modal-backdrop fade show"></div>')
      } else {
        $('body').removeClass('modal-open')
        $('body div[class*="modal-backdrop"]:last').remove()
      }
    }
  },
  mounted: function () {
    document.addEventListener('keydown', (e) => {
      if (this.show && e.keyCode == 27) {
        this.close()
      }
    })
  },
  methods: {
    close() {
      this.$emit('close')
    },
  }
}
</script>

<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow-y: auto;
  /*background-color: rgba(0, 0, 0, .5);*/
  transition: opacity .3s ease;
}
</style>
