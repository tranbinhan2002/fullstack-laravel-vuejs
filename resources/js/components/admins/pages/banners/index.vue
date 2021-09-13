<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Banner</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">List Banner</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="content-top mb-2">
          <div class="input-group">
            <div class="form-outline">
              <input
                type="search"
                v-model="search"
                @keyup="getBanners()"
                id="form1"
                class="form-control"
                placeholder="Search"
              />
            </div>
            <button type="submit" class="btn btn-outline-dark">
              <i class="fas fa-search"></i>
            </button>
          </div>
          <router-link :to="{ name: 'banner-create' }">
            <button type="button" class="btn btn-outline-dark">
              <i class="fas fa-plus-square"> Create</i>
            </button>
          </router-link>
        </div>

        <div class="content-table">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(banner, index) in banners.data" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>
                  <img
                    class="img-thumbnail"
                    width="150"
                    :src="banner.image"
                    alt=""
                  />
                </td>
                <td>{{ banner.name }}</td>
                <td v-html="banner.description"></td>
                <td>
                  <el-switch
                    v-model="banner.status"
                    active-color="#13ce66"
                    inactive-color="#ff4949"
                    :active-value="1"
                    :inactive-value="0"
                    @change="changeStatus(banner)"
                  >
                  </el-switch>
                </td>
                <td>
                  <router-link
                    :to="{ name: 'banner-edit', params: { id: banner.id } }"
                  >
                    <button type="button" class="btn btn-outline-dark">
                      <i class="fas fa-edit"> Edit</i>
                    </button>
                  </router-link>
                  <a @click.prevent="deleteBanner(banner)">
                    <button type="button" class="btn btn-outline-dark">
                      <i class="fas fa-trash-alt"> Delete</i>
                    </button>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="pagination">
            <pagination :data="banners" @pagination-change-page="getBanners">
              <span slot="prev-nav">&lt; Prev</span>
              <span slot="next-nav">Next &gt;</span>
            </pagination>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      banners: {},
      search: "",
    };
  },
  created() {
    this.getBanners();
  },
  methods: {
    getBanners(page = 1) {
      this.callApi(
        "get",
        `/api/banner?page=${page}&search=${this.search}`
      ).then((res) => {
        this.banners = res.data;
      });
    },
    deleteBanner(banner) {
      this.$swal
        .fire({
          title: "Are you sure delete?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.callApi("delete", `/api/banner/${banner.id}`).then(() => {
              this.$swal.fire(
                "Deleted!",
                "Your file has been deleted.",
                "success"
              );
              this.getBanners();
            });
          }
        });
    },
    changeStatus(banner) {
      this.callApi("put", `/api/change-status-banner/${banner.id}`).then(
        () => {
          this.$swal.fire({
            icon: "success",
            title: "Change status successfully",
          });
        }
      );
    },
  },
};
</script>

<style scoped>
.content-top {
  display: flex;
  justify-content: space-between;
}
.input-group {
  align-items: center;
}
.pagination {
  display: flex;
  justify-content: center;
}
</style>
