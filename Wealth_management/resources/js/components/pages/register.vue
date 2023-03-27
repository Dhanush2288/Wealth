<template>
  <div class="container-fluid new_div">
    <div class="row rowlogindiv">
      <div class="col-lg-5">
        <div class="logo">LOGO</div>
        <div class="imgdiv">
          <div class="imgrom">
            <img src="image\4880556.jpg" alt="" class="srcimg" />
            <div class="caplogin">
              <h1 class="text-center soi">Share your Idea to best Mind</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7 pagelogin">
        <button
          @click="$router.push('/')"
          type="submit"
          class="btn btn-lg btn-dark btnsign"
        >
          Sign in
        </button>
        <div class="contact">
          <h1 class="loginh1">Sign UP</h1>
          <p>
            Welcome ! enter
          </p>
          <form class="uploadsign" id="file-form">
            <div class="mb-3">
              <label for="floatingInput" class="inga">Full Name</label>

              <input
                type="text"
                class="form-control form-control-lg"
                id="Fullnmae"
                placeholder="Full name"
                v-model="form.name"
              />
              <div class="invalid-feedback">
                Please enter a message in the textarea.
              </div>
            </div>
            <div class="mb-3">
              <label for="floatingInput" class="inga">Email address</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="floatingInputemail"
                placeholder="name@example.com"
                v-model="form.email"
              />
              <div class="invalid-feedback">
                Please enter a message in the textarea.
              </div>
            </div>
            <div class="mb-3">
              <label for="floatingInput" class="inga">Role</label>

              <select class="form-select" aria-label="Default select example" v-model="form.role_id">
                <option selected> Select Role</option>
                <option value="4">Client</option>
                <option value="3">Creator</option>
                <option value="2">Manager</option>
              </select>
              <div class="invalid-feedback">
                Please enter a message in the textarea.
              </div>
            </div>

            <div class="mb-3">
              <label for="floatingInput" class="inga">Password</label>

              <input
                type="password"
                class="form-control form-control-lg"
                name="password"
                id="floatingInputpassword"
                placeholder="name@example.com"
                v-model="form.password"
              />
              <div class="invalid-feedback">
                Please enter a message in the textarea.
              </div>
            </div>
            <div class="mb-3">
              <label for="floatingPassword" class="inga"
                >Confrim Password</label
              >

              <input
                type="password"
                class="form-control form-control-lg"
                id="floatingPassword "
                placeholder="Confrim Password"
                v-model="form.c_password"
              />
            </div>

            <button
              @click.prevent="saveForm"
              type="submit"
              class="btn btn-lg btn-dark btnlogin"
            >
              Login
            </button>
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
      form: {
        name: "",
        email: "",
        password: "",
        c_password: "",
        role_id: "",
      },
      errors: [],
    };
  },
  methods: {
    saveForm() {
      axios
        .post("/api/register", this.form)
        .then(() => {
          this.$router.push({ name: "Login" });
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
<style scoped>
.new_div {
  height: 100vh;
}
.rowlogindiv {
  height: 100%;
}
.pagelogin {
  position: relative;
  background: #eceef0;
}
.contact {
  width: 50%;

  margin-top: 5%;
  margin-left: 100px;
}
.loginh1 {
  font-weight: 700;
  font-size: 55px;
  font-family: "Poppins", sans-serif;
}
.imgrom {
  display: flex;
}
.srcimg {
  width: 90%;
  margin: auto;
}
.logo {
  font-weight: 700;
  font-size: 35px;
  font-family: "Poppins", sans-serif;
  margin: 10px;
}
.imgdiv {
  height: 80%;
}
.imgrom {
  height: 100%;
  position: relative;
}
.caplogin {
  position: absolute;
  bottom: 0;
  width: 100%;
}
.soi {
  font-weight: 700;
  font-size: 35px;
  font-family: "Poppins", sans-serif;
}
.inga {
  font-weight: 600;
  font-size: 19px;
  margin-bottom: 7px;
  font-family: "Poppins", sans-serif;
}
.form-control::placeholder {
  font-family: "Poppins", sans-serif;
  color: #b4b4b4;
}
.btnlogin {
  width: 200px;
  padding: 10px;
  margin-top: 10px;
  background: #5e8782;
}
.btnsign {
  width: 100px;
  padding: 10px;
  margin-top: 10px;
  background: #ad67c8;
  float: right;
}
</style>
