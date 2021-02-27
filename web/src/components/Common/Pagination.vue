<template>
  <div class="row mt-2">
    <div class="col-md-6">
                  <small>Mostrando {{source.data && source.data.length ? source.data.length : 0}} de {{source.total}} resultados.</small>
    </div>
    <div class="col-md-6">
      <nav aria-label="Page navigation example">
        <ul class="pagination pagination-sm justify-content-end">
          <li :class="{disabled: source.current_page === 1, 'page-item': true}">
            <a href="#" class="page-link" @click="nextPrev($event, source.current_page - 1)">Anterior</a>
          </li>

          <li :class="{active: source.current_page === page, 'page-item': true}" v-for="page in pages"
              track-by="$index">

            <span class="page-link" v-if="page == '...'">{{page}}</span>

            <a href="#" class="page-link" v-if="page != '...'" @click="navigate($event, page)">{{page}}</a>
          </li>

          <!--                    <li :class="{disabled: source.current_page === source.last_page, 'page-item': true}">-->
          <!--                        <a href="#" class="page-link" @click="nextPrev($event, source.current_page + 1)">Próximo</a>-->
          <!--                    </li>-->

          <li :class="{disabled: source.next_page_url === null, 'page-item': true}">
            <a href="#" class="page-link" @click="nextPrev($event, source.current_page + 1)">Próximo</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>

export default {
  name: 'Pagination',
  props: ['source'],
  data () {
    return {
      pages: []
    }
  },
  watch: {
    source () {

      let s = this.source

      this.pages = this.generatePagesArray(s.current_page, s.total, s.per_page, 12)
    }
  },
  methods: {
    navigate (event, page) {

      event.preventDefault()

      this.$parent.navegate(page)
    },
    nextPrev (event, page) {

      if (page === 0 || page == this.source.last_page + 1) {
        return
      }

      this.navigate(event, page)

    },
    generatePagesArray: function (currentPage, collectionLength, rowsPerPage, paginationRange) {

      let pages = []

      let totalPages = Math.ceil(collectionLength / rowsPerPage)

      let halfWay = Math.ceil(paginationRange / 2)

      let ellipsesNeeded = paginationRange < totalPages

      let position

      if (currentPage <= halfWay) {
        position = 'start'
      } else if (totalPages - halfWay < currentPage) {
        position = 'end'
      } else {
        position = 'middle'
      }


      let i = 1

      while (i <= totalPages && i <= paginationRange) {

        let pageNumber = this.calculatePageNumber(i, currentPage, paginationRange, totalPages)

        let openingEllipsesNeeded = (i === 2 && (position === 'middle' || position === 'end'))

        let closingEllipsesNeeded = (i === paginationRange - 1 && (position === 'middle' || position === 'start'))

        if (ellipsesNeeded && (openingEllipsesNeeded || closingEllipsesNeeded)) {
          pages.push('...')
        } else {
          pages.push(pageNumber)
        }
        i++
      }
      return pages
    },
    calculatePageNumber: function (i, currentPage, paginationRange, totalPages) {

      let halfWay = Math.ceil(paginationRange / 2)

      if (i === paginationRange) {
        return totalPages
      } else if (i === 1) {
        return i
      } else if (paginationRange < totalPages) {
        if (totalPages - halfWay < currentPage) {
          return totalPages - paginationRange + i
        } else if (halfWay < currentPage) {
          return currentPage - halfWay + i
        } else {
          return i
        }
      } else {
        return i
      }
    }
  }

}
</script>

<style scoped>

</style>
