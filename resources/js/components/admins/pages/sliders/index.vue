<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">List Slider</li>
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
                @keyup="getSliders"
                id="form1"
                class="form-control"
                placeholder="Search"
              />
            </div>
            <button type="submit" class="btn btn-outline-dark">
              <i class="fas fa-search"></i>
            </button>
          </div>
          <router-link :to="{ name: 'slider-create' }">
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
              <tr v-for="(slider, index) in sliders.data" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>
                  <img
                    class="img-thumbnail"
                    width="150"
                    :src="slider.image"
                    alt=""
                  />
                </td>
                <td>{{ slider.name }}</td>
                <td v-html="slider.description"></td>
                <td>
                  <el-switch
                    v-model="slider.status"
                    active-color="#13ce66"
                    inactive-color="#ff4949"
                    :active-value="1"
                    :inactive-value="0"
                    @change="changeStatus(slider)"
                  >
                  </el-switch>
                </td>
                <td>
                  <router-link
                    :to="{ name: 'slider-edit', params: { id: slider.id } }"
                  >
                    <button type="button" class="btn btn-outline-dark">
                      <i class="fas fa-edit"> Edit</i>
                    </button>
                  </router-link>
                  <a @click.prevent="deleteSlider(slider)">
                    <button type="button" class="btn btn-outline-dark">
                      <i class="fas fa-trash-alt"> Delete</i>
                    </button>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="pagination">
            <pagination :data="sliders" @pagination-change-page="getSliders">
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
      sliders: {},
      search: "",
    };
  },
  created() {
    this.getSliders();
  },
  methods: {
    getSliders(page = 1) {
      this.callApi(
        "get",
        `/api/slider?page=${page}&search=${this.search}`
      ).then((res) => {
        this.sliders = res.data;
      });
    },
    deleteSlider(slider) {
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
            this.callApi("delete", `/api/slider/${slider.id}`).then(() => {
              this.$swal.fire(
                "Deleted!",
                "Your file has been deleted.",
                "success"
              );
              this.getSliders();
            });
          }
        });
    },
    changeStatus(slider) {
      this.callApi("put", `/api/change-status-slider/${slider.id}`).then(
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
