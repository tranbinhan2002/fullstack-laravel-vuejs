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
              <li class="breadcrumb-item active">Create Category</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
           <form @submit.prevent="createCategory">
          <div class="form-group">
            <label>Category name</label>
            <input
              type="text"
              v-model="form.name"
              class="form-control"
              :class="{ 'is-invalid': form.errors.has('name') }"
              placeholder="Enter category name"
            />
             <div
              v-if="form.errors.has('name')"
              v-html="form.errors.get('name')"
            />
          </div>
          <button type="submit" class="btn btn-outline-dark">
            <i class="fas fa-save"> Save</i>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return{
      form: new Form({
          name: '',
      })
    }
  },
  methods: {
    createCategory(){
      this.form.post('/api/category').then(res => {
        if(res.status == 200){
            this.$swal.fire({
              icon: "success",
              title: "Create category successfully",
            });
            this.$router.push({name: 'category'});
        }
      }).catch(error => {
        console.log(error)
      })
    }
  }
};
</script>

<style>
</style>