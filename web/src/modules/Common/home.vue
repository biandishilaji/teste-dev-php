<template>

  <div class="page-content">
    <!-- Main content -->
    <div class="content-wrapper">

      <!-- Content area -->
      <div class="content d-flex justify-content-center align-items-center">

        <!-- Container -->
        <div class="flex-fill">

        </div>
        <!-- /container -->

      </div>
      <!-- /content area -->

    </div>
    <!-- /main content -->

  </div>
</template>

<script>

  export default {
    name: 'Home',
    middleware: ['check-auth', 'auth'],
    data () {
      return {
        unreadCount: 0
      }
    },

  }
</script>
