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
              <li class="breadcrumb-item active">Create Slider</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="main-body">
          <form @submit.prevent="createSlider" enctype="multipart/form-data">
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
        description: "",
      }),
      imagePreview: null,
      showPreview: false,
    };
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
    createSlider() {
      this.form.post("/api/slider").then((res) => {
        if (res.status == 200) {
          this.$swal.fire({
            icon: "success",
            title: "Create slider successfully",
          });
          this.$router.push({ name: "slider" });
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
</style>