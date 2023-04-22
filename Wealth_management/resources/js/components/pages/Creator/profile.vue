<template>
  <div>
    <div class="w3-sidebar sidenav w3-bar-block" style="width: 17%">
      <Nav></Nav>
    </div>
    <div style="margin-left: 17%">
      <div class="container contain">
        <img :src="asset('image/cover.png')" class="bgforcover" />
        <img
          :src="avatarUrl"
          class="bgforprofile"
        />
        <div class="doctorname">
          <h4 class="">{{ this.users.name }}</h4>
          <p>{{ this.users.email }}</p>
        </div>
      </div>
      <div class="container">
        <div>
          <h5>Preferred investment</h5>

          <div class="Clearr">
            <div class="muldiv">
              <label class="typo__label">Product Tags</label>
              <multiselect
                v-model="Productvalue"
                :options="Productoptions"
                :multiple="false"
                :preserve-search="true"
                placeholder="Products"
                label="name"
                track-by="name"
              >
              </multiselect>
            </div>
            <div class="muldiv">
              <label class="typo__label">Currency</label>
              <multiselect
                v-model="Currencyvalue"
                :options="Currencyoptions"
                :multiple="false"
                :preserve-search="true"
                placeholder="Currency"
                label="name"
                track-by="name"
              >
              </multiselect>
            </div>

            <div class="muldiv">
              <label class="typo__label">Risk</label>
              <multiselect
                v-model="Riskvalue"
                :options="Riskoptions"
                :multiple="false"
                placeholder="Risk"
                label="name"
                track-by="name"
              >
              </multiselect>
            </div>
            <div class="muldiv">
              <label class="typo__label">Max value</label>
              <div>
                <vue-slider
                  v-model="form.maxrange"
                  :min="0"
                  :max="10000"
                  :interval="10"
                ></vue-slider>
              </div>
            </div>
            <div class="muldiv">
              <button class="btn btn-dark w-100 mt-4" @click="save()">
                Save
              </button>
            </div>
          </div>
        </div>
        <div class="tablerey shadow p-3 mb-5 bg-white rounded">
          <div class="Options">
            <h1 class="Health">Past Preferred Records</h1>
          </div>
          <div class="fsf">
            <table class="table">
                <thead>
                    <th>
                        Product name
                    </th>
                    <th>
                        Currency name
                    </th>
                    <th>
                        Risk rating
                    </th>
                    <th>
                        Max range
                    </th>
                    <th>

                    </th>
                </thead>
              <tr
                v-for="(value, index) in ideas"
                class="bor-f"
                v-bind:key="index"
              >
                <td >{{ value.product_name }}</td>
                <td>{{ value.currency_name }}</td>

                <td>
                  {{ value.risk_rating ? value.risk_rating + " Rating" : " " }}
                </td>
                <td>{{ value.maxrange }}</td>

                <td>
                  <button class="btn bop" @click="gotoeditblog(value)">
                    Set Preferred
                  </button>
                  <!-- <button class="btn bop  " style="margin-left: 5px;" @click="gotoeditblog(value)">
                    Delete
                  </button> -->
                </td>

              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
    <script>
import Nav from "../reuseable/nav.vue";
import Multiselect from "vue-multiselect";
import VueDatePicker from "@vuepic/vue-datepicker";
import Swal from "sweetalert2";
import VueSlider from "vue-slider-component";
import "vue-slider-component/theme/default.css";
import topnav from "../reuseable/topnav.vue";

export default {
  components: {
    Nav,
    Multiselect,
    VueDatePicker,
    VueSlider,
    topnav
  },
  data() {
    return {
      users: "",
      user: {},
      value: 50,
      itemId: null,
      ideas: [],
      avatar:null,
      form: {
        product_id: "",
        region_id: "",
        currency_id: "",
        country_id: "",
        risk_rating: "",
        maxrange: "",
      },
      Productvalue: [],
      Productoptions: [],
      Currencyvalue: [],
      Currencyoptions: [],
      Riskvalue: [],
      Riskoptions: [
        { name: "1", id: "1" },
        { name: "2", id: "2" },
        { name: "3", id: "3" },
        { name: "4", id: "4" },
        { name: "5", id: "5" },
      ],
      Countryvalue: [],
      Countryoptions: [],
    };
  },
  computed: {
    avatarUrl() {
        const type = this.avatar;
       const baseUrl = `https://api.dicebear.com/6.x/big-smile/svg?seed=${type}&backgroundColor=c0aede&backgroundType=gradientLinear&flip=true`;

      return baseUrl;

    },
  },
  methods: {
    gotoeditblog(value) {
      console.log(value, "value");
      this.form.product_id = value.product_id;
      this.form.currency_id = value.currency_id;
      this.form.risk_rating = value.risk_rating;
      this.form.user_id = this.users.id;
      this.form.status = 1;
      this.form.maxrange = value.maxrange;

      axios.post("/api/createpreferred", this.form).then((res) => {
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

        this.Productvalue = this.Productoptions.find(
          (option) => option.id == value.product_id
        );
        this.Currencyvalue = this.Currencyoptions.find(
          (option) => option.id == value.currency_id
        );
        this.Riskvalue = this.Riskoptions.find(
          (option) => option.id == value.risk_rating
        );
        this.form.maxrange = value.maxrange;
        console.log(this.Riskvalue);
        console.log(this.form, "this.form", this.Riskvalue);
        this.getPreferreddetail(this.users.id);
      });
    },
    getuserdetail(id) {
      var form = {
        id: id,
      };
      axios.post("/api/userfirst", form).then((res) => {
        if (res.status == 200) {
          this.user = res.data.data;
          this.getblogs();
        }
      });
    },
    getblogs() {
      var form = {
        user_id: this.users.id,
      };
      axios.post("/api/getallpreferred", form).then((res) => {
        if (res.status == 200) {
          this.ideas = res.data.data;
          console.log(this.ideas);
        }

        this.form;
      });
    },
    gotoeditblog1() {
      axios.post("/api/getall").then((res) => {
        if (res.status == 200) {
          this.Productoptions = res.data.data["project_types"];
          this.Currencyoptions = res.data.data["currency"];
          this.Countryoptions = res.data.data["country"];
          this.Regionoptions = res.data.data["regions"];
        }
      });
    },
    save() {
      this.form.product_id = this.Productvalue.id;
      this.form.currency_id = this.Currencyvalue.id;
      this.form.risk_rating = this.Riskvalue.id;
      this.form.user_id = this.users.id;
      console.log(this.form, "this.form", this.Riskvalue);

      axios.post("/api/createpreferred", this.form).then((res) => {
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
    getPreferreddetail(id) {
      var form = {
        user_id: id,
      };
      axios.post("/api/getpreferred", form).then((res) => {
        if (res.status == 200) {
          this.ideas = res.data.data;

          this.Productvalue = this.Productoptions.find(
            (option) => option.id == this.ideas.product_id
          );
          this.Currencyvalue = this.Currencyoptions.find(
            (option) => option.id == this.ideas.currency_id
          );
          this.Riskvalue = this.Riskoptions.find(
            (option) => option.id == this.ideas.risk_rating
          );
          this.form.maxrange = this.ideas.maxrange;
          console.log(this.Riskvalue);
        }
      });
    },
  },
  mounted() {
    const f = localStorage.getItem("user");
    this.users = JSON.parse(f);
    this.itemId = this.$route.params.id;
    this.gotoeditblog1();

    this.getPreferreddetail(this.users.id);
    this.getblogs();
    this.avatar=localStorage.getItem("avatar")

  },
};
</script>
    <style scoped>
.doctorname {
  display: block;
  position: relative;
  bottom: 137px;
  text-align: center;
  margin: 0 auto 0 auto;
}
.contain {
  height: 400px;
}
.doctorname p {
  margin-bottom: 0px;
  font-family: Arial, Helvetica, sans-serif;
  color: #848e8e;
}
.doctorname h4 {
  font-size: 160%;
  font-family: "Poppins", sans-serif;
  font-weight: 800;
  margin-bottom: 0px;
}
.bop {
  padding: 10px;
}
.Clearr {
  display: flex;
  justify-content: space-evenly;
  padding: 15px;
  background: #e7e2f8;
}
.muldiv {
  width: 200px;
}
.vue-slider {
  height: 8px;
  margin-top: 10px;
}
.bgforcover {
  width: 100%;
}
.Options {
  height: 50px;
  width: 100%;
  background-color: black;
  color: white;
  padding-top: 13px;
}
.Health {
  margin-left: 10px;
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-size: 18px;
}
.tablerey {
  margin-top: 25px;
  height: 50vh;
  overflow: auto;
  width: 90%;
  margin: auto;
  margin-top: 15px;
}
.bgforprofile {
  border-radius: 100%;
  width: 199px;
  /* position: absolute; */
  /* bottom: -35px; */
  /* left: 50%; */
  /* transform: translateY(-50%); */
  margin-left: auto;
  margin-right: auto;
  display: block;
  position: relative;
  bottom: 137px;
}
.fsf {
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  font-size: 14px;
}
.fsf td {
  vertical-align: middle;
}
.fsf button {
    font-family: 'Poppins';
    border: none;
    padding: 5px 25px;
    font-weight: 600;
    padding-bottom: 3px;
    background: #913175;
    color: #ffffff;
    border-radius: 5px;
}
.details td {
  color: #394b55;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  font-size: 14px;
}
.details th {
  color: #80919b;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  font-size: 14px;
}
</style>
