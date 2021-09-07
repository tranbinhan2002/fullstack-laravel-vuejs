<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">List Product</li>
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
                @keyup="getProducts"
                id="form1"
                class="form-control"
                placeholder="Search"
              />
            </div>
            <button type="submit" class="btn btn-outline-dark">
              <i class="fas fa-search"></i>
            </button>
          </div>
          <router-link :to="{ name: 'product-create' }">
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
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(product, index) in products.data" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td @click="productDatail(product)">
                  <img
                    class="img-thumbnail"
                    width="150"
                    :src="product.image"
                    alt=""
                  />
                </td>
                <td>{{ product.name }}</td>
                <td>{{ product.category.name }}</td>
                <td> {{ formatPrice(product.price) }}</td>
                <td>
                  <el-switch
                    v-model="product.status"
                    active-color="#13ce66"
                    inactive-color="#ff4949"
                    :active-value="1"
                    :inactive-value="0"
                    @change="changeStatus(product)"
                  >
                  </el-switch>
                </td>
                <td>
                  <router-link
                    :to="{ name: 'product-edit', params: { id: product.id } }"
                  >
                    <button type="button" class="btn btn-outline-dark">
                      <i class="fas fa-edit"> Edit</i>
                    </button>
                  </router-link>
                  <a @click.prevent="deleteProduct(product)">
                    <button type="button" class="btn btn-outline-dark">
                      <i class="fas fa-trash-alt"> Delete</i>
                    </button>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="pagination">
            <pagination :data="products" @pagination-change-page="getProducts">
              <span slot="prev-nav">&lt; Prev</span>
              <span slot="next-nav">Next &gt;</span>
            </pagination>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div
        class="modal fade"
        id="createUser"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">User Detail</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <div class="main-body">
                <div class="row gutters-sm">
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <div class="card-body">
                        <div
                          class="
                            d-flex
                            flex-column
                            align-items-center
                            text-center
                          "
                        >
                          <img :src="product.image" alt="product" width="200" />
                          <div class="mt-3">
                            <h4>{{ product.name }}</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Slug:</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ product.slug }}
                          </div>
                        </div>
                        <hr />
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Price:</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{formatPrice(product.price)  }}
                          </div>
                        </div>
                        <hr />
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Status:</h6>
                          </div>
                          <div class="col-sm-9 text-secondary" v-if="product.status == 1">
                            ON
                          </div>
                           <div class="col-sm-9 text-secondary" v-else>
                            OFF
                          </div>
                        </div>
                        <hr />
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Category:</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ product.category }}
                          </div>
                        </div>
                        <hr />
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">User:</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ product.user }}
                          </div>
                        </div>
                        <hr />
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Description:</h6>
                          </div>
                          <div
                            class="col-sm-9 text-secondary"
                            v-html="product.description"
                          ></div>
                        </div>
                        <hr />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-outline-dark"
                data-bs-dismiss="modal"
              >
                <i class="fas fa-window-close"> Cancel</i>
              </button>
              <button type="submit" @click.prevent="editProductDeatail(product.id)" class="btn btn-outline-dark">
                <i class="fas fa-edit"> Edit</i>
              </button>
            </div>
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
      product: {
        id: "",
        name: "",
        slug: "",
        image: "",
        price: "",
        description: "",
        category: "",
        user: "",
        status: "",
      },
      products: {},
      search: "",
    };
  },
  created() {
    this.getProducts();
  },
  methods: {
    formatPrice(value) {
        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 0
        });
        return formatter.format(value);
    },
    getProducts(page = 1) {
      this.callApi(
        "get",
        `/api/product?page=${page}&search=${this.search}`
      ).then((res) => {
        this.products = res.data;
      });
    },
    deleteProduct(product) {
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
            this.callApi("delete", `/api/product/${product.id}`).then(() => {
              this.$swal.fire(
                "Deleted!",
                "Your file has been deleted.",
                "success"
              );
              this.getProducts();
            });
          }
        });
    },
    changeStatus(product) {
      this.callApi("put", `/api/change-status-product/${product.id}`).then(
        () => {
          this.$swal.fire({
            icon: "success",
            title: "Change status successfully",
          });
        }
      );
    },
    productDatail(product) {
      $("#createUser").modal("show");
       this.product.id = product.id;
      this.product.name = product.name;
      this.product.slug = product.slug;
      this.product.image = product.image;
      this.product.price = product.price;
      this.product.description = product.description;
      this.product.category = product.category.name;
      this.product.user = product.user.name;
      this.product.status = product.status;
    },
     editProductDeatail(id){
      this.$router.push({ name: "product-edit", params: {id}  });
      $("#createUser").modal("hide");
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
