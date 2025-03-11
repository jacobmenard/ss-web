<script setup lang="ts">

</script>

<template>
  <div class="main-container">
    <b-container>
      <!-- <NuxtRouteAnnouncer />
      <NuxtWelcome /> -->
      <NuxtLayout>
        
        <NuxtPage />
        
      </NuxtLayout>

      
      
    </b-container>

    <div class="footer-main-container">
      <b-container>
        <footer-main></footer-main>
      </b-container>
    </div>

  </div>
</template>

<style lang="scss">
  .main-container {
    .container {
      @include mid-resolution {
        min-width: 1680px;
      }

      @include resolution(991px) {
        max-width: 900px;
      }
    }
  }
</style>