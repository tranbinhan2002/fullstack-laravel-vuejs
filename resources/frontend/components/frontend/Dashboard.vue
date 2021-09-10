<template>
  <div class="animsition">
    <app-header ></app-header>
     <app-slider v-if="$route.name =='home'"></app-slider>
      <app-banner v-if="$route.name =='home'"></app-banner>
    <router-view></router-view>
    <app-footer></app-footer>
    <div class="btn-back-to-top" id="myBtn">
      <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
      </span>
    </div>
  </div>
</template>

<script>

import AppFooter from "./layouts/Footer.vue";
import AppHeader from "./layouts/Header.vue";
import AppBanner from "./layouts/Banner.vue";
import AppSlider from "./layouts/Slider.vue";
export default {
  components: { AppHeader, AppFooter, AppSlider, AppBanner },
};
</script>

<style>
</style>