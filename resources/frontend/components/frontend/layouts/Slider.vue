<template>
  <section class="section-slide">
    <div class="wrap-slick1">
      <div class="slick1">
        <el-carousel :interval="4000" type="card" height="400px">
          <el-carousel-item v-for="slider in sliders" :key="slider.id">
            	<div class="item-slick1" :style="{ 'background-image': 'url(' + slider.image + ')' }">
              </div>
          </el-carousel-item>
        </el-carousel>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      sliders: [],
    };
  },
  created() {
    this.getSlider();
  },
  methods: {
    getSlider() {
      this.callApi("get", "/api/fresh-slider").then((res) => {
        this.sliders = res.data;
      });
    },
  },
};
</script>

<style scoped>

</style>