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
        @click="$router.push('/register')"
              type="submit"
          class="btn btn-lg btn-dark btnsign"
        >
          Sign up
        </button>
        <div class="contact">
          <h1 class="loginh1">Login</h1>
          <p>
            Welcome back! Login with your data that you entered during
            registration
          </p>
          <form class="uploadsign" id="file-form">
            <div class="mb-3">
              <label for="floatingInput" class="inga">Email address</label>

              <input
                type="text"
                class="form-control form-control-lg"
                name="email2"
                id="floatingInputemail"
                placeholder="name@example.com"
                v-model="form.email"
              />
              <div class="invalid-feedback">
                Please enter a message in the textarea.
              </div>
            </div>

            <div class="mb-3">
              <label for="floatingPassword" class="inga">Password</label>

              <input
                name="pass2"
                type="password"
                class="form-control form-control-lg"
                id="floatingPassword "
                placeholder="Password"
                v-model="form.password"
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
        email: "",
        password: "",
      },
      errors: [],
    };
  },
  methods: {
    saveForm() {
      axios
        .post("/api/login", this.form)
        .then((res) => {
          if (res.data.success) {
            this.$store.dispatch("login", {
              user: res.data.user[0],
            });
            localStorage.setItem("user", JSON.stringify(res.data.user[0]));

            var user = res.data.user[0];
            var redirectTo = {};
            console.log(user.usertype);
            if (user.usertype === "Manager") {
              redirectTo = { name: "manager" };
            } else if (user.usertype === "admin") {
              redirectTo = { name: "admin" };
            } else if (user.usertype === "creator") {
              redirectTo = { name: "creator" };
            } else if (user.usertype === "client") {
              redirectTo = { name: "client" };
            }
            console.log(redirectTo);

            this.$router.push(redirectTo).catch((err) => {});
          }
          console.log(this.$store.getters.isAuthenticated);
        })
        .catch((error) => {
          console.log(error, "error");
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

  margin-top: 25%;
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
