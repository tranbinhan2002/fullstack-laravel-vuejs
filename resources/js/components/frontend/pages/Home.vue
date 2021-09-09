<template>
  <div>
    <app-slider></app-slider>
    <app-banner></app-banner>
  </div>
</template>

<script>
import AppBanner from "../layouts/Banner.vue";
import AppSlider from "../layouts/Slider.vue";
export default {
   components: { AppSlider, AppBanner },
};
</script>

<style>
</style>