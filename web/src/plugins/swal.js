import Swal from 'sweetalert2'

export default {
  alert: function (description, success) {
    if (success) {
      this.success(description)
    } else {
      this.error(description)
    }
  },
  success: function (description, callback) {
    Swal({
      title: 'Sucesso!',
      html: description,
      type: 'success',
      confirmButtonClass: 'btn btn-confirm mt-2'
    }).then(callback)
  },
  error: function (description) {
    Swal({
      title: 'Erro!',
      html: description,
      type: 'error',
      confirmButtonClass: 'btn btn-primary mt-2'
    })
  },
  warning: function (description) {
    Swal({title: 'Atenção!', html: description, type: 'warning'})
  },
  confirm: function (description) {
    return Swal({
      title: 'Atenção',
      html: description,
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sim',
      cancelButtonText: 'Não',
      confirmButtonClass: 'btn btn-success mt-2',
      cancelButtonClass: 'btn btn-danger ml-2 mt-2',
      buttonsStyling: false
    })
  },
  prompt: function (description, value, callback) {
    Swal({
      title: description,
      input: 'text',
      showCancelButton: true,
      confirmButtonText: 'Enviar',
      cancelButtonText: 'Cancelar',
      showLoaderOnConfirm: false,
      confirmButtonClass: 'btn btn-primary mt-2',
      cancelButtonClass: 'btn btn-danger ml-2 mt-2',
      allowOutsideClick: false,
      buttonsStyling: false,
      inputValue: value
    }).then(callback)
  },
}
