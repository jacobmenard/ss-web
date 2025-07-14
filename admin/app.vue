<script setup lang="ts"></script>

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
    width: 100%;

    @include mid-resolution {
      min-width: 1680px;
    }

    @include mobile-lg {
      min-width: unset;
      width: 100%;
      padding: 0;
    }
  }
}
</style>
