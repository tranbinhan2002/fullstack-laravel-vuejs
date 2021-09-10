<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">List User</li>
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
              v-model="search"
              @keyup="getUser"
                type="search"
                id="form1"
                class="form-control"
                placeholder="Search"
              />
            </div>
            <button type="button" class="btn btn-outline-dark">
              <i class="fas fa-search"></i>
            </button>
          </div>
          <router-link :to="{ name: 'user-create' }">
            <button type="button" class="btn btn-outline-dark">
              <i class="fas fa-plus-square"> Create</i>
            </button>
          </router-link>
        </div>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Avatar</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users.data" :key="index">
              <th scope="row">{{ index + 1 }}</th>
              <td @click="userDatail(user)">
                <img
                  class="img-thumbnail"
                  width="150"
                  :src="user.avatar"
                  alt=""
                />
              </td>
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.role_user }}</td>
              <td>
                <el-switch
                  v-model="user.status"
                  active-color="#13ce66"
                  inactive-color="#ff4949"
                  :active-value="1"
                  :inactive-value="0"
                  @change="changeStatus(user)"
                >
                </el-switch>
              </td>
              <td>
                <router-link
                  :to="{ name: 'user-edit', params: { id: user.id } }"
                >
                  <button type="button" class="btn btn-outline-dark">
                    <i class="fas fa-edit"> Edit</i>
                  </button>
                </router-link>

                <a @click.prevent="deleteUser(user)">
                  <button type="button" class="btn btn-outline-dark">
                    <i class="fas fa-trash-alt"> Delete</i>
                  </button>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="pagination">
          <pagination :data="users" @pagination-change-page="getUser">
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
                        <img
                          :src="form.avatar"
                          alt="Admin"
                          class="rounded-circle"
                          width="200"
                        />
                        <div class="mt-3">
                          <h4>{{ form.name }}</h4>
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
                          <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{ form.email }}
                        </div>
                      </div>
                      <hr />
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Gender</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{ form.gender }}
                        </div>
                      </div>
                      <hr />
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Birthday</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{ form.birthday }}
                        </div>
                      </div>
                      <hr />
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{ form.phone }}
                        </div>
                      </div>
                      <hr />
                       <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Role</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{ form.role_user }}
                        </div>
                      </div>
                      <hr/>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{ form.address }}
                        </div>
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
              <button @click="editUserDeatail(form.id)" type="submit" class="btn btn-outline-dark">
                <i class="fas fa-edit"> Edit</i>
              </button>
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
      form: new Form({
        id: "",
        name: "",
        email: "",
        phone: "",
        avatar: "",
        gender: "",
        role_user: "",
        address: "",
        birthday: "",
        password: "",
      }),
      users: {},
      search: '',
      imagePreview: null,
      showPreview: false,
    };
  },
  created() {
    this.getUser();
    this.$on("AfterCreate", () => {
      this.getUser();
    });
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
    getUser(page = 1) {
      this.callApi("get", `/api/user?page=${page}&search=${this.search}`).then((res) => {
        this.users = res.data;
      });
    },
    userDatail(user) {
      this.form.reset();
      $("#createUser").modal("show");
      // $("#createUser").modal("hide");
      //  this.$emit("AfterCreate");
      this.form.fill(user);
    },
    editUserDeatail(id){
      this.$router.push({ name: "user-edit", params: {id}  });
      $("#createUser").modal("hide");
    },
    changeStatus(user) {
      this.callApi("put", `/api/change-status-user/${user.id}`).then(() => {
        this.$swal.fire({
          icon: "success",
          title: "Change status successfully",
        });
      });
    },
    deleteUser(user) {
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
            this.callApi("delete", `/api/user/${user.id}`).then((res) => {
              if (res.status == 200) {
                this.$emit("AfterCreate");
                this.$swal.fire(
                  "Deleted!",
                  "Your file has been deleted.",
                  "success"
                );
              }
            });
          }
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.content-top {
  display: flex;
  justify-content: center;
}
.input-group {
  align-items: center;
}
.text-secondary {
  display: flex;
}
.pagination {
  display: flex;
  justify-content: center;
}
</style>