<script setup lang="ts">

</script>

<template>
  <div class="main-container">
    <b-container class="px-0">
      <!-- <NuxtRouteAnnouncer />
      <NuxtWelcome /> -->
      <NuxtLayout>
        
        <NuxtPage />
        
      </NuxtLayout>

    
    </b-container>

  </div>
</template>

<style lang="scss">
  .main-container {
    .container {
      max-width: unset;
      @include mid-resolution {
        min-width: 1680px;
      }
    }
  }
</style>