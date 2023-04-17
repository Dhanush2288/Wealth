<template>
  <div>
    <div class="w3-sidebar sidenav w3-bar-block" style="width: 17%">
      <Nav></Nav>
    </div>
    <!-- Page Content -->
    <div style="margin-left: 17%">
      <topnav></topnav>
      <div class="blogcre">
        <h1>Assign Blog</h1>
        <div class="blog">
          <form class="uploadsign" id="file-form">
            <div class="form-floating mb-3">
              <input
                type="text"
                class="form-control"
                id="floatingInput"
                placeholder="Title"
                v-model="form.title"
                disabled
              />
              <label for="floatingInput">Title</label>
            </div>
            <div class="form-floating mb-3">
              <textarea
                class="form-control"
                placeholder="Leave a comment here"
                id="floatingTextarea"
                style="height: 70px"
                v-model="form.abstract"
                disabled
              ></textarea>
              <label for="floatingInput">Abstract</label>
            </div>
            <div class="form-floating mb-3">
              <textarea
                class="form-control"
                placeholder="Leave a comment here"
                id="floatingTextarea"
                style="height: 200px"
                v-model="form.content"
                disabled
              ></textarea>
              <label for="floatingInput">Content</label>
            </div>
            <div
              style="
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
              "
              disabled
            >
              <div class="muldiv">
                <label class="typo__label">Product Tags</label>
                <div class="oi">
                  <multiselect
                    disabled
                    v-model="Productvalue"
                    :options="Productoptions"
                    :preserve-search="true"
                    placeholder="Products"
                    label="name"
                    track-by="id"
                  >
                  </multiselect>
                </div>
              </div>
              <div class="muldiv">
                <label class="typo__label">Currency</label>
                <multiselect
                  disabled
                  v-model="Currencyvalue"
                  :options="Currencyoptions"
                  :preserve-search="true"
                  placeholder="Currency"
                  label="name"
                  track-by="id"
                >
                </multiselect>
              </div>
            </div>
            <div
              style="
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
              "
            >
              <div class="muldiv">
                <label class="typo__label">Country</label>
                <multiselect
                  disabled
                  v-model="Countryvalue"
                  :options="Countryoptions"
                  :preserve-search="true"
                  placeholder="Country"
                  label="name"
                  track-by="id"
                >
                </multiselect>
              </div>
              <div class="muldiv">
                <label class="typo__label">Region</label>
                <multiselect
                  disabled
                  v-model="Regionvalue"
                  :options="Regionoptions"
                  :preserve-search="true"
                  placeholder="Currency"
                  label="name"
                  track-by="id"
                >
                </multiselect>
              </div>
            </div>
            <div
              style="
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
              "
            >
              <div class="muldiv">
                <label class="typo__label">Risk</label>
                <multiselect
                  disabled
                  v-model="Riskvalue"
                  :options="Riskoptions"
                  :preserve-search="true"
                  placeholder="Risk"
                  label="name"
                  track-by="name"
                >
                </multiselect>
              </div>
              <div class="form-floating mb-3 muldiv">
                <input
                  type="text"
                  class="form-control"
                  id="floatingInput"
                  placeholder="Max value"
                  v-model="form.maxrange"
                  disabled
                />
                <label for="floatingInput">Max value</label>
              </div>
            </div>
            <div class="muldiv">
              <label class="typo__label">expiry date</label>
              <VueDatePicker
                disabled
                v-model="form.expiry_at"
                placeholder="Start Typing ..."
                text-input
              />
            </div>
          </form>
          <div>
            <button class="btn btn-dark m-3" @click="po()">Assign</button>
          </div>
        </div>
      </div>
    </div>
    <custom-modal
      @message-sent="handleMessage"
      ref="customModal"
    ></custom-modal>
  </div>
</template>
        <script>
import Select from "datatables.net-select";
import Multiselect from "vue-multiselect";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import Swal from "sweetalert2";
import $ from "jquery";
import CustomModal from "./modalrm.vue";
import Nav from "../reuseable/rmnav.vue";
import topnav from "../reuseable/topnav.vue";
export default {
  components: {
    Multiselect,
    VueDatePicker,
    CustomModal,
    Nav,
    topnav,
  },
  data() {
    return {
        users:null,
      ideas: null,
      itemId: null,
      form: {
        title: "",
        abstract: "",
        risk: "",
        creator_id: "",
        content: "",
        expiry_at: null,
        maxrange: null,
      },
      Productvalue: null,
      Productoptions: [
        { name: "Equity", id: "1" },
        { name: "BOnd", id: "2" },
      ],
      Currencyvalue: [],
      Currencyoptions: [{ name: "Rupee", id: "1" }],
      Riskvalue: [],
      Riskoptions: [
        { name: "1", id: "1" },
        { name: "2", id: "2" },
        { name: "3", id: "3" },
        { name: "4", id: "4" },
        { name: "5", id: "5" },
      ],
      Regionvalue: [],
      Regionoptions: [
        { name: "TN", id: "1" },
        { name: "AP", id: "2" },
        { name: "KL", id: "3" },
        { name: "VD", id: "4" },
        { name: "5", id: "5" },
      ],
      Countryvalue: [],
      Countryoptions: [
        { name: "India", id: "1" },
        { name: "UK", id: "2" },
        { name: "US", id: "2" },
      ],
    };
  },
  methods: {
    po() {
      this.$refs.customModal.showModal();
    },
    handleMessage(message) {
      console.log(message, "message-sent");
      var form={
        manager_id: this.users.id,
        blog_id:this.itemId,
        assigned_user:message
      }

       axios.post("/api/createassigned", form).then((res) => {
         const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
          },
        });

        if (res.status == 200) {
          Toast.fire({
            icon: "success",
            title: "assigned to a client successfully",
          });
          this.$router.push("/manager");
        } else {
          console.log("sdfsd");
          Toast.fire({
            icon: "Danger",
            title: "Something went wrong",
          });
        }
      });
    },
    Savepublish() {
      console.log($);
      const utcDate1 = new Date(this.form.expiry_at)
        .toISOString()
        .replace("T", " ")
        .replace("Z", "");
      console.log(this.Productvalue);
      this.form.product_id = this.Productvalue.id;
      this.form.currency_id = this.Currencyvalue.id;
      this.form.region_id = this.Regionvalue.id;
      this.form.country_id = this.Countryvalue.id;
      this.form.risk = this.Riskvalue.name;
      this.form.creator_id = 3;
      this.form.expiry_at = utcDate1;
      console.log(this.form);
      axios.post("/api/createblog", this.form).then((res) => {
        this.form;
        console.log(this.form);
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
          },
        });

        Toast.fire({
          icon: "success",
          title: "created in successfully",
        });
      });
    },
    getblogdetail(id) {
      var form = {
        blog_id: id,
      };
      axios.post("/api/getblogs", form).then((res) => {
        if (res.status == 200) {
          this.ideas = res.data.data[0];
          this.form.title = this.ideas.title;
          this.form.abstract = this.ideas.abstract;
          this.form.risk = this.ideas.risk;
          this.form.creator_id = this.ideas.creator_id;
          this.form.content = this.ideas.content;
          this.form.expiry_at = this.ideas.expiry_at;
          this.form.maxrange = this.ideas.maxrange;
          this.Productvalue = this.Productoptions.find(
            (option) => option.id == this.ideas.product_id
          );
          this.Currencyvalue = this.Currencyoptions.find(
            (option) => option.id == this.ideas.currency_id
          );
          this.Regionvalue = this.Regionoptions.find(
            (option) => option.id == this.ideas.region_id
          );
          this.Countryvalue = this.Countryoptions.find(
            (option) => option.id == this.ideas.country_id
          );
          this.Riskvalue = this.Riskoptions.find(
            (option) => option.id == this.ideas.risk
          );
          console.log(this.Riskvalue);
        }
      });
    },

    gotoeditblog() {
      axios.post("/api/getall").then((res) => {
        if (res.status == 200) {
          this.Productoptions = res.data.data["project_types"];
          this.Currencyoptions = res.data.data["currency"];
          this.Countryoptions = res.data.data["country"];
          this.Regionoptions = res.data.data["regions"];
          this.getblogdetail(this.itemId);

        }
      });
    },
  },
  mounted() {
    this.itemId = this.$route.params.id;
    this.gotoeditblog();

    const f = localStorage.getItem("user");
    this.users = JSON.parse(f);
  },
};
</script>
        <style scoped>
.muldiv {
  width: 45%;
}

.nav-links {
  margin-top: 10vh;
  display: block;
  padding-left: 3rem;
  justify-content: space-between;
  z-index: 1 !important;
}
.close .nav-links {
  transition: all 0.3s ease-in-out;
  padding-left: 2rem !important;
}
.close .nav-links a .textspan {
  transition: all 0.3s ease-in-out;
  display: none;
}
.nav-links a {
  text-decoration: none;
  font-size: 20px;
  color: rgb(0, 0, 0);
  font-weight: 700;
}

.nav-links a i {
  font-size: 28px;
  text-decoration: none;
  padding-left: 10px;
}
.nav-links li {
  margin-top: 20px;
  margin-left: 5px;
  list-style: none;
  display: flex;
  cursor: pointer;
  padding: 10px;
}
.nav-links i {
  font-size: 19px;
  text-decoration: none;
  padding-top: 5px;
}
.nav-links li:hover {
  background: #e7e2f8;
  color: #533f8f;
  border-radius: 5px;
  margin-right: 10px;
}
.nav-links li span:hover {
  font-weight: 700;
  color: #533f8f;
}
.active1 {
  padding-bottom: 3px;
  background: #e7e2f8;
  color: #685998;
  border-radius: 5px;
  margin-right: 10px;
}
.active1 .textspan {
  /* color: black; */
  font-weight: 700;
  color: #533f8f;
}
.sidenav {
  background: #f4f4f8;
}
.logo {
  font-weight: 700;
  font-size: 35px;
  font-family: "Poppins", sans-serif;
  margin: 10px;
}
.as {
  width: 52px;
  border-radius: 66px;
  height: 52px;
}
.profilee {
  display: flex;
  width: 264px;
  float: right;
  margin-top: 13px;
}
.topnav {
  height: 73px;
  background: #f4f4f8;
}
.h5sd {
  display: inline;
  margin: auto 5px;
  font-size: 14px;
  font-family: "Poppins";
  font-weight: 600;
}
.blogcre {
  width: 80%;
  margin: auto;
  margin-top: 38px;
}
.blog {
  margin-top: 30px;
}
</style>
        <style src="vue-multiselect/dist/vue-multiselect.css"></style>
