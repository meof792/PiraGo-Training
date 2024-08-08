<template>
  <div>
    <div class="nav-row">
      <div class="row">
        <Navbar />
        <div class="col-lg-12 col-md-12 col-12">
          <MainPage />
        </div>
      </div>
    </div>
    <div class="nav-column">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-2">
          <Navbar />
        </div>
        <div class="col-lg-10 col-md-10 col-10">
          <MainPage />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

import Navbar from "./Navbar.vue";
import MainPage from "./MainPage.vue";

import { onMounted } from "vue";
import { useRouter } from 'vue-router';

const router = useRouter();

onMounted(() => {
  if (!localStorage.getItem("id")) {
    alert("Bạn chưa đăng nhập!");
    router.push("/login");
  }
});
</script>

<style scoped>
.col-lg-2,
.col-md-2,
.col-2,
.col-lg-10,
.col-md-10,
.col-10 {
  padding: 0;
  margin: 0;
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
