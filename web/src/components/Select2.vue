<template>
  <select ref='select'>
    <slot></slot>
  </select>
</template>
<script>

require('@/assets/js/plugins/forms/selects/select2.min.js')
require('@/assets/js/plugins/forms/selects/i18n/pt-BR')

export default {
  name: 'Select2',
  props: ['options', 'value'],
  mounted: function () {
    let vm = this
    $(this.$refs.select)
      // init select2
      .select2({
        data: this.options,
        width: '100%',
        language: 'pt-BR'
      })
      .val(this.value)
      .trigger('change')
      // emit event on change.
      .on('change', function () {
        vm.$emit('input', $(this).val())
      })
  },
  watch: {
    value: function (value) {

      value = value && typeof value === 'string' ? value.split(',') : value

      value = value ? value : ''

      if (([...value].sort().join(",") !== [...$(this.$refs.select).val()].sort().join(","))) {
        $(this.$refs.select).val(value).trigger('change');
      }
    },
    options: function (options) {
      $(this.$refs.select).find('option').not("option:first").remove()
      $(this.$refs.select).select2({data: options})
    }
  },
  destroyed: function () {
    $(this.$refs.select).off().select2('destroy')
  }
}
</script>

<style>

</style>
