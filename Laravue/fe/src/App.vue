<template>
  <div>
    <div class="nav-row">
      <div class="row">
        <Navbar />
        <div class="col-lg-12 col-md-12 col-12">
          <router-view></router-view>
        </div>
      </div>
    </div>
    <div class="nav-column">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-2">
          <Navbar />
        </div>
        <div class="col-lg-10 col-md-10 col-10">
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Navbar from "./views/NavbarPage.vue";
</script>

<style>
body {
  overflow-x: hidden;
  /* overflow-y: hidden; */
}

.nav-row {
  display: none;
}

.nav-column {
  display: block;
}

@media (max-width: 768px) {
  .nav-row {
    display: block;
  }

  .nav-column {
    display: none;
  }
}
</style>
