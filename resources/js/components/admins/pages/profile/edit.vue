<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="main-body">
          <form @submit.prevent="updateUser" enctype="multipart/form-data">
            <div class="row">
              <div class="col-lg-4">
                <div class="card">
                  <h2 class="m-2">Change Avatar</h2>
                  <div class="card-body">
                    <div
                      class="d-flex flex-column align-items-center text-center"
                    >
                      <img
                        v-show="showPreview"
                        :src="imagePreview"
                        alt="Admin"
                        class="rounded-circle p-1 bg-primary"
                        width="250"
                      />
                      <img
                        v-if="showPreview == false"
                        :src="form.avatar"
                        alt="Admin"
                        class="rounded-circle p-1 bg-primary"
                        width="250"
                      />
                      <input
                        type="file"
                        class="form-control-file"
                        @change="onFileChange"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="card">
                  <h2 class="m-2">Change Infomation</h2>
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
                        />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          disabled
                          v-model="form.email"
                          type="text"
                          class="form-control"
                        />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Gender</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="gender"
                            v-model="form.gender"
                            value="men"
                            id="flexRadioDefault1"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault1"
                          >
                            Men
                          </label>
                        </div>
                        <div class="form-check ml-2">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="gender"
                            value="women"
                            v-model="form.gender"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            Women
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Phone</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          type="text"
                          v-model="form.phone"
                          class="form-control"
                        />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Birthday</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <el-date-picker
                          v-model="form.birthday"
                          type="date"
                          placeholder="Pick a day"
                          format="yyyy/MM/dd"
                          value-format="yyyy-MM-dd"
                        >
                          >
                        </el-date-picker>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Address</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          type="text"
                          v-model="form.address"
                          class="form-control"
                        />
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

          <form @submit.prevent="changePassword">
            <div class="row change-password">
              <div class="col-sm-8">
                <div class="card">
                  <h2 class="m-2">Change Password</h2>
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Current password</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          :type="showPassword ? 'text' : 'password'"
                          v-model="formChangePassword.current_password"
                          :class="{
                            'is-invalid':
                              formChangePassword.errors.has('current_password'),
                          }"
                          class="form-control"
                        />
                        <div class="show-password">
                          <i
                            @click="handleShowPassword()"
                            v-if="showPassword"
                            class="fas fa-eye"
                          ></i>
                          <i
                            @click="handleShowPassword()"
                            class="fas fa-eye-slash"
                            v-else
                          ></i>
                        </div>
                      </div>
                      <div
                        v-if="formChangePassword.errors.has('current_password')"
                        v-html="
                          formChangePassword.errors.get('current_password')
                        "
                      />
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">New password</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          :type="showPassword ? 'text' : 'password'"
                          v-model="formChangePassword.new_password"
                          :class="{
                            'is-invalid':
                              formChangePassword.errors.has('new_password'),
                          }"
                          class="form-control"
                        />
                        <div class="show-password">
                          <i
                            @click="handleShowPassword()"
                            v-if="showPassword"
                            class="fas fa-eye"
                          ></i>
                          <i
                            @click="handleShowPassword()"
                            class="fas fa-eye-slash"
                            v-else
                          ></i>
                        </div>
                      </div>
                      <div
                        v-if="formChangePassword.errors.has('new_password')"
                        v-html="formChangePassword.errors.get('new_password')"
                      />
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Confirm password</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          :type="showPassword ? 'text' : 'password'"
                          v-model="formChangePassword.confirm_password"
                          :class="{
                            'is-invalid':
                              formChangePassword.errors.has('confirm_password'),
                          }"
                          class="form-control"
                        />
                        <div class="show-password">
                          <i
                            @click="handleShowPassword()"
                            v-if="showPassword"
                            class="fas fa-eye"
                          ></i>
                          <i
                            @click="handleShowPassword()"
                            class="fas fa-eye-slash"
                            v-else
                          ></i>
                        </div>
                      </div>
                      <div
                        v-if="formChangePassword.errors.has('confirm_password')"
                        v-html="
                          formChangePassword.errors.get('confirm_password')
                        "
                      />
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
      formChangePassword: new Form({
        current_password: "",
        new_password: "",
        confirm_password: "",
        _method: "put",
      }),

      form: new Form({
        name: "",
        email: "",
        phone: "",
        avatar: "",
        gender: "",
        address: "",
        birthday: "",
        password: "",
        _method: "put",
      }),
      imagePreview: null,
      showPreview: false,
      showPassword: false,
    };
  },
  created() {
    this.getUser();
  },
  methods: {
    onFileChange(event) {
      this.form.avatar = event.target.files[0];
      let reader = new FileReader();
      reader.addEventListener(
        "load",
        function () {
          this.showPreview = true;
          this.imagePreview = reader.result;
        }.bind(this),
        false
      );
      if (this.form.avatar) {
        if (/\.(jpe?g|png|gif)$/i.test(this.form.avatar.name)) {
          reader.readAsDataURL(this.form.avatar);
        }
      }
    },
    getUser() {
      this.callApi("get", "/api/profile").then((res) => {
        this.form.name = res.data.name;
        this.form.email = res.data.email;
        this.form.phone = res.data.phone;
        this.form.avatar = res.data.avatar;
        this.form.gender = res.data.gender;
        this.form.address = res.data.address;
        this.form.birthday = res.data.birthday;
      });
    },
    updateUser() {
      let id = this.$route.params.id;
      this.form.post(`/api/profile/${id}`).then((res) => {
        if (res.status == 200) {
          this.$swal.fire({
            icon: "success",
            title: "Update profile successfully",
          });
          this.$router.push({ name: "profile" });
        }
      });
    },
    changePassword() {
      let id = this.$route.params.id;
      this.formChangePassword
        .put(`/api/profile/change-password/${id}`)
        .then((res) => {
          if (res.status == 200) {
            this.$swal.fire({
              icon: "success",
              title: "Update profile successfully",
            });
            this.callApi("post", "/api/logout").then((res) => {
              if (res.status == 200) {
                this.$router.push({ name: "login" });
              }
            });
          }
        });
    },
    handleShowPassword() {
      this.showPassword = this.showPassword == false ? true : false;
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