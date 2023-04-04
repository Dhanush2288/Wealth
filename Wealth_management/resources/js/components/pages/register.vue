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
          <p>Welcome ! enter</p>
          <form class="uploadsign" id="file-form">
            <div class="mb-3">
              <label for="floatingInput" class="inga">Full Name</label>

              <input
                type="text"
                class="form-control form-control-lg"
                id="Fullnmae"
                placeholder="Full name"
                v-model="form.name"
                :class="{ 'is-invalid': !validName }"
              />
              <div v-if="formSaved && !validName" class="invalid-feedback">
                Please enter a valid name.
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
                :class="{ 'is-invalid': !validEmail }"
              />
              <div class="invalid-feedback">Please enter a correct email.</div>
            </div>
            <div class="mb-3">
              <label for="floatingInput" class="inga">Role</label>

              <select
                class="form-select"
                aria-label="Default select example"
                v-model="form.role_id"
                :class="{ 'is-invalid': !validRole }"
              >
                <option selected>Select Role</option>

                <option
                  v-for="(role, index) in roles"
                  :key="index"
                  :value="role.id"
                >
                  {{ role.name }}
                </option>
              </select>
              <div class="invalid-feedback">Please select Role.</div>
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
                :class="{ 'is-invalid': !validPassword }"
              />
              <div class="invalid-feedback">Please enter Password.</div>
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
                :class="{ 'is-invalid': !validConfirmPassword }"
              />
              <div class="invalid-feedback">Please enter Confrim Password.</div>
            </div>

            <button
              @click.prevent="saveForm"
              type="submit"
              class="btn btn-lg btn-dark btnlogin"
            >
              Sign up
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Swal from "sweetalert2";

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
      roles: [],
      formSaved: false,
    };
  },
  computed: {
    validName() {
      return !this.formSaved || this.form.name !== "";
    },
    validEmail() {
      return !this.formSaved || this.form.email.length !== 0;
    },
    validPassword() {
      return !this.formSaved || this.form.password.length >= 6;
    },
    validConfirmPassword() {
      return !this.formSaved || this.form.c_password === this.form.password;
    },
    validRole() {
      return !this.formSaved || this.form.role_id !== "";
    },
    formIsValid() {
      return (
        this.validName &&
        this.validEmail &&
        this.validPassword &&
        this.validConfirmPassword &&
        this.validRole
      );
    },
  },
  methods: {
    saveForm() {

      this.formSaved = true;
      if (this.formIsValid) {
        axios
          .post("/api/register", this.form)
          .then((response) => {
            if(response.status==200){
                this.$router.push({ name: "Login" });
                Swal.fire("Registered successful!", "You Registered Registered.", "success");

            }else{
                Swal.fire("something Worng!", "Danger");

            }
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
          });
      }
    },
    getForm() {
      axios
        .post("/api/getroles", this.form)
        .then((response) => {
            if(response.status==200){
                this.roles = response.data.data;

            }else{

            }
          console.log(this.roles);
        })
        .catch((error) => {
          console.log(error);
          this.errors = error.response.data.errors;
        });
    },
  },
  mounted() {
     this.getForm();
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
