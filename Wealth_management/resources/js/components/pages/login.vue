<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-7"></div>
      <div class="col-lg-5">
        <div class="contact">
          <form class="uploadsign" id="file-form">
            <div class="form-floating mb-3">
              <input
                type="text"
                class="form-control"
                name="email2"
                id="floatingInput"
                placeholder="name@example.com"
                v-model="form.email"
              />
              <label for="floatingInput">Email address</label>
              <div class="invalid-feedback">
                Please enter a message in the textarea.
              </div>
            </div>

            <div class="form-floating mb-3">
              <input
                name="pass2"
                type="password"
                class="form-control"
                id="floatingPassword"
                placeholder="Password"
                v-model="form.password"
              />
              <label for="floatingPassword">Password</label>
            </div>

            <button
              @click.prevent="saveForm"
              type="submit"
              class="btn btn-dark"
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
            localStorage.setItem('user', JSON.stringify(res.data.user[0]) );

           var user =res.data.user[0];
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
            console.log(error,"error");
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
