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
              <li class="breadcrumb-item active">Update Product</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="main-body">
          <form @submit.prevent="updateProduct" enctype="multipart/form-data">
            <div class="row">
              <div class="col-lg-4">
                <div class="card">
                  <h2 class="m-2">Image</h2>
                  <div class="card-body">
                    <div
                      class="d-flex flex-column align-items-center text-center"
                    >
                      <img
                        v-show="showPreview"
                        :src="imagePreview"
                        alt="product"
                        width="250"
                      />
                       <img
                       v-if="showPreview == false"
                        :src="form.image"
                        alt="product"
                        width="250"
                      />
                      <input
                        type="file"
                        class="form-control-file"
                        :class="{
                          'is-invalid': form.errors.has('image'),
                        }"
                        @change="onFileChange"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="card">
                  <h2 class="m-2">Infomation</h2>
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Name</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          v-model="form.name"
                          type="text"
                          class="form-control"
                          :class="{
                            'is-invalid': form.errors.has('name'),
                          }"
                        />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Price</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          v-model="form.price"
                          type="number"
                          class="form-control"
                          :class="{
                            'is-invalid': form.errors.has('price'),
                          }"
                        />
                      </div>
                    </div>
                     <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Category</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <select
                          class="form-control"
                          :class="{
                            'is-invalid': form.errors.has('category_id'),
                          }"
                          v-model="form.category_id"
                        >
                          <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Decription</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <ckeditor
                          :class="{
                            'is-invalid': form.errors.has('description'),
                          }"
                          v-model="form.description"
                        ></ckeditor>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3"></div>
                      <div class="col-sm-9 text-secondary">
                        <button type="submit" class="btn btn-outline-dark">
                          <i class="fas fa-edit"> Save</i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        name: "",
        image: "",
        price: "",
        description: "",
        category_id: "",
        _method: 'put'
      }),
      categories: {},
      imagePreview: null,
      showPreview: false,
    };
  },
  created(){
    this.getCategory();
    this.getProduct();
  },
  methods: {
    onFileChange(event) {
      this.form.image = event.target.files[0];
      let reader = new FileReader();
      reader.addEventListener(
        "load",
        function () {
          this.showPreview = true;
          this.imagePreview = reader.result;
        }.bind(this),
        false
      );
      if (this.form.image) {
        if (/\.(jpe?g|png|gif)$/i.test(this.form.image.name)) {
          reader.readAsDataURL(this.form.image);
        }
      }
    },
     getProduct() {
        let id = this.$route.params.id;
        this.callApi("get", `/api/product/${id}/edit`).then((res) => {
        this.form.name = res.data.name;
        this.form.category_id = res.data.category_id;
         this.form.price = res.data.price;
        this.form.description = res.data.description;
        this.form.image = res.data.image;
      });
    },
    getCategory(){
      this.callApi('get','/api/category').then(res => {
         this.categories = res.data.data;
      }); 
    },
    updateProduct() {
       let id = this.$route.params.id;
      this.form.post(`/api/product/${id}`).then((res) => {
        if (res.status == 200) {
          this.$swal.fire({
            icon: "success",
            title: "Update product successfully",
          });
          this.$router.push({ name: "product" });
        }
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.text-secondary {
  display: flex;
}
.change-password {
  justify-content: flex-end;
}
.text-secondary {
  position: relative;
  align-items: center;
  .show-password {
    position: absolute;
    right: 30px;
  }
}
</style>