  <template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">

            </div>
            <div class="col-lg-5">
                <div class="contact">
    <form class="uploadsign" id="file-form">
      <div class="form-floating mb-3">
        <input
          type="text"
          class="form-control"
          id="floatingInput"
          name="name31"
          placeholder="Name"
          v-model="form.name"
        />
        <label for="floatingInput">Name</label>
        <div class="invalid-feedback">
          Please enter a message in the textarea.
        </div>
      </div>
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
      <div class=" form-floating mb-3">
        <select
          class="form-select"
          required
          aria-label="select example"
          v-model="form.role_id"
        >
          <option value="">Open this select menu</option>
          <option value="0">One</option>
          <option value="1">Two</option>
          <option value="2">Three</option>
        </select>
        <div class="invalid-feedback">Example invalid select feedback</div>
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
      <div class="form-floating mb-3">
        <input
          type="password"
          class="form-control"
          id="floatingPassword"
          placeholder="confrim Password"
          v-model="form.c_password"
        />
        <label for="floatingPassword">Password</label>
      </div>
      <button @click.prevent="saveForm" type="submit" class="btn btn-dark">Register</button>
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
            this.$router.push({ name: "Login"});
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
