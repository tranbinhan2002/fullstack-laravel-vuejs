<template>
  <div class="wrapper">
   <app-header></app-header>
     <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <app-side-bar></app-side-bar>
     </aside>

    <div class="content-wrapper">
     <router-view></router-view>
    </div>

   <app-footer></app-footer>
  </div>
</template>

<script>
import AppFooter from './layouts/Footer.vue';
import AppHeader from './layouts/Header.vue';
import AppSideBar from './layouts/SideBar.vue';
export default {
  components: { AppHeader, AppSideBar, AppFooter },};
</script>

<style>
</style>