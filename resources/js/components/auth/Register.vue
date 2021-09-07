<template>
  <div class="login">
    <div class="titulo">Register</div>
    <form @submit.prevent="register" method="post">
      <div class="form-group">
        <input
          v-model="form.name"
          :class="{ 'is-invalid': form.errors.has('name') }"
          type="text"
          placeholder="Name"
        />
        <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
      </div>
      <div class="form-group">
        <input
          type="text"
          v-model="form.email"
          :class="{ 'is-invalid': form.errors.has('email') }"
          placeholder="Email"
        />
         <div v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
      </div>
      <div class="form-group">
        <input
          type="password"
          :class="{ 'is-invalid': form.errors.has('password') }"
          v-model="form.password"
          placeholder="Password"
        />
         <div v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
      </div>
      <div class="form-group">
        <input
          type="password"
          v-model="form.password_confirmation"
          placeholder="Password confirmation"
          :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
        />
         <div v-if="form.errors.has('password_confirmation')" v-html="form.errors.get('password_confirmation')" />
      </div>
      <div class="btn-submit">
        <button @click.prevent="back" class="enviar mr-2" type="submit">
          <i class="fas fa-arrow-left"> Back</i>
        </button>
        <button class="enviar" type="submit">Register</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      }),
    };
  },
  methods: {
    register() {
      this.form
        .post("/api/register")
        .then((res) => {
          if (res.status == 200) {
            this.$swal.fire({
              icon: "success",
              title: "Registration successfully",
            });
            this.$router.push({ name: "login" });
          } else {
            this.$swal.fire({
              icon: "error",
              title: "Registration Failed",
              text: "Something went wrong!",
            });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    back() {
      this.$router.push({ name: "login" });
    },
  },
};
</script>

<style lang="scss" scoped>
.signup {
  font-size: 1rem;
}
.login {
  width: 500px;
  height: 450px;
  overflow: hidden;
  background: #1e1e1e;
  border-radius: 6px;
  margin: 50px auto;
  box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.8);
}

.login .titulo {
  width: 500px;
  height: 50px;
  padding-top: 13px;
  padding-bottom: 13px;
  font-size: 14px;
  text-align: center;
  color: #bfbfbf;
  font-weight: bold;
  background: #121212;
  border: #2d2d2d solid 1px;
  margin-bottom: 30px;
  border-top-right-radius: 6px;
  border-top-left-radius: 6px;
  font-family: Arial;
}

.login form {
  width: 300px;
  height: auto;
  overflow: hidden;
  margin-left: auto;
  margin-right: auto;
}

.login form input[type="text"],
.login form input[type="password"] {
  width: 300px;
  font-size: 12px;
  padding-top: 14px;
  padding-bottom: 14px;
  padding-left: 40px;
  border: none;
  color: #bfbfbf;
  background: #141414;
  outline: none;
  margin: 0;
}

.login form input[type="text"] {
  border-top-left-radius: 6px;
  border-top-right-radius: 6px;
  border-top: #0b0b0b solid 1px;
}

.login form input[type="password"] {
  border-bottom-left-radius: 6px;
  border-bottom-right-radius: 6px;
  border-top: #0b0b0b 1px solid;
  border-bottom: #353535 1px solid;
}
.btn-submit {
  display: flex;
}

.login form .enviar {
  width: 300px;
  height: 40px;
  display: block;
  padding-top: 10px;
  padding-bottom: 14px;
  border-radius: 6px;
  border: none;
  border-top: #4eb2a8 1px solid;
  border-bottom: #161616 1px solid;
  background: #349e92;
  text-align: center;
  text-decoration: none;
  font-size: 12px;
  font-weight: bold;
  color: #fff;
  text-shadow: 0 -1px #1d7464, 0 1px #7bb8b3;
  font-family: Arial;
}

.login .olvido {
  height: auto;
  overflow: hidden;
  padding-top: 25px;
  padding-bottom: 25px;
  font-size: 10px;
  text-align: center;
}

.login .olvido .col {
  width: 50%;
  height: auto;
  float: left;
}

.login .olvido .col a {
  color: #fff;
  text-decoration: none;
  font: 12px Arial;
}

ol,
ul {
  list-style: none;
}

blockquote,
q {
  quotes: none;
}
</style>>
