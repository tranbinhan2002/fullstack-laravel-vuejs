<template>
  <div>
    <router-link :to="{ name: 'dashboard' }" class="brand-link">
      <img
        src="/admin/dist/img/AdminLTELogo.png"
        class="brand-image img-circle elevation-3"
        style="opacity: 0.8"
      />
      <span class="brand-text font-weight-light">LaraVue</span>
    </router-link>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img
            :src="user.avatar"
            class="img-circle elevation-2"
            alt="User Image"
          />
        </div>
        <div class="info">
          <a class="d-block">{{ user.name }}</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <router-link :to="{ name: 'category' }" class="nav-link">
                  <i class="fas fa-certificate nav-icon"></i>
                  <p>Category</p>
                </router-link>
              </li>
               <li class="nav-item">
                <router-link :to="{ name: 'product' }" class="nav-link">
                 <i class="fab fa-product-hunt nav-icon"></i>
                  <p>Product</p>
                </router-link>
              </li>
               <li class="nav-item">
                <router-link :to="{ name: 'user' }" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>User</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'profile' }" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
                <span class="right badge "><i class="fas fa-kiss-wink-heart"></i></span>
              </p>
            </router-link>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: "",
    };
  },
  created() {
    this.getUser();
     this.$on("AfterCreate", () => {
      this.getUser();
    });
  },
  methods: {
    getUser() {
      this.callApi("get", "/api/profile").then((res) => {
        this.user = res.data;
      });
    },
  },
};
</script>

<style>
</style>