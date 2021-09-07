<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">List Category</li>
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
                  @keyup="getCategories"
                  id="form1"
                  class="form-control"
                  placeholder="Search"
                />
              </div>
              <button type="submit" class="btn btn-outline-dark">
                <i class="fas fa-search"></i>
              </button>
            </div>
          <router-link :to="{ name: 'category-create' }">
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
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(category, index) in categories.data" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ category.name }}</td>
                <td>{{ category.slug }}</td>
                <td>
                  <el-switch
                    v-model="category.status"
                    active-color="#13ce66"
                    inactive-color="#ff4949"
                    :active-value="1"
                    :inactive-value="0"
                    @change="changeStatus(category)"
                  >
                  </el-switch>
                </td>
                <td>
                  <router-link
                    :to="{ name: 'category-edit', params: { id: category.id } }"
                  >
                    <button type="button" class="btn btn-outline-dark">
                      <i class="fas fa-edit"> Edit</i>
                    </button>
                  </router-link>
                  <a @click.prevent="deleteCategory(category)">
                    <button type="button" class="btn btn-outline-dark">
                      <i class="fas fa-trash-alt"> Delete</i>
                    </button>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="pagination">
            <pagination
              :data="categories"
              @pagination-change-page="getCategories"
            >
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
      categories: {},
      search: "",
    };
  },
  created() {
    this.getCategories();
  },
  methods: {
    getCategories(page = 1) {
      this.callApi("get", `/api/category?page=${page}&search=${this.search}`).then((res) => {
        this.categories = res.data;
      });
    },
    deleteCategory(category) {
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
            this.callApi("delete", `/api/category/${category.id}`).then(() => {
              this.$swal.fire(
                "Deleted!",
                "Your file has been deleted.",
                "success"
              );
              this.getCategories();
            });
          }
        });
    },
    changeStatus(category) {
      this.callApi("put", `/api/change-status-category/${category.id}`).then(
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
