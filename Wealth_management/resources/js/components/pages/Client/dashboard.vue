<template>
  <div>
    <div class="w3-sidebar sidenav w3-bar-block" style="width: 17%">
      <Nav></Nav>
    </div>
    <!-- Page Content -->
    <div style="margin-left: 17%">
      <topnav></topnav>

      <div class="bing m-5">
        <h2 class="texth2">Investment Ideas</h2>
        <div class="Clearr">
          <div class="muldiv">
            <label class="typo__label">Product Tags</label>
            <multiselect
              v-model="Productvalue"
              :options="Productoptions"
              :multiple="true"
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
              :multiple="true"
              :preserve-search="true"
              placeholder="Currency"
              label="name"
              track-by="name"
            >
            </multiselect>
          </div>

          <div class="muldiv2">
            <label class="typo__label">Risk</label>
            <multiselect
              v-model="Riskvalue"
              :options="Riskoptions"
              :multiple="true"
              placeholder="Risk"
              label="name"
              track-by="name"
            >
            </multiselect>
          </div>
          <div class="muldiv">
            <label class="typo__label">Date</label>
            <VueDatePicker
              v-model="form.startdate"
              placeholder="Date"
              text-input
            />
          </div>

          <div class="muldiv1">
            <Button class="btn btn-dark w-100 mt-4" @click="getblogs()">
              Search</Button
            >
          </div>
        </div>
        <div class="shadow p-3 bg-white rounded">
          <table class="table table-borderless">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 25%">Investment Idea</th>
                <th scope="col">Product</th>
                <th scope="col">Currency</th>

                <th scope="col">Max value</th>

                <th scope="col">Risk</th>

                <th scope="col" style="width: 5 %">Date</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(value, index) in ideas"
                class="bor-f"
                v-bind:key="index"
              >
                <th scope="row">{{ index + 1 }}</th>
                <td>
                  <div class="bio">
                    <p class="Tit">{{ value.title }}</p>
                    <p class="Paraab">
                      {{ value.abstract }}
                    </p>
                  </div>
                </td>
                <td class="align-middle prod-tag">
                  <div>
                    <p class=" ">{{ value.product_name }}</p>
                  </div>
                </td>
                <td class="align-middle prod-tag">
                  <div>
                    <p class=" ">{{ value.currency_name }}</p>
                  </div>
                </td>
                <td class="align-middle prod-tag">
                  <div>
                    <p class=" ">{{ value.maxrange }}</p>
                  </div>
                </td>
                <td class="align-middle">
                  <button class="btn">{{ value.risk }}</button>
                </td>

                <td class="align-middle">{{ formatDate(value.created_at) }}</td>
                <td class="align-middle">
                  <button
                    class="btn btn-success mr-1"
                    @click="proceedblog(value.assigned_id, 1)"
                  >
                    Proceed
                  </button>
                  <button
                    class="btn delete_btn mr-1"
                    @click="dblog(value.assigned_id, 2)"
                  >
                    Cancel
                  </button>
                  <button class="btn btn-secondary" @click="goToView(value.id)">
                    <font-awesome-icon :icon="['fass', 'eye']" />
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
      <script>
import Select from "datatables.net-select";
import Multiselect from "vue-multiselect";
import VueDatePicker from "@vuepic/vue-datepicker";
import Swal from "sweetalert2";
import Nav from "../reuseable/clientnav.vue";
import topnav from "../reuseable/topnav.vue";

export default {
  components: {
    Multiselect,
    VueDatePicker,
    Nav,
    topnav,
  },
  data() {
    return {
      users: null,
      ideas: [],
      form: {
        product_id: "",
        region_id: "",
        currency_id: "",
        creator_id: "",
        country_id: "",
        manager_id: "",
        startdate: "",
        risk: "",
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
  methods: {
    goToView(id) {
      this.$router.push(`/viewclient/${id}`);
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleString();
    },
    dblog(id, status) {
      Swal.fire({
        title: "Are you sure ?",
        text: "to cancel!",
        icon: "sucess",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, cancel!",
      }).then((result) => {
        if (result.isConfirmed) {
          var form = {
            id: id,
            status: status,
          };
          axios.post("/api/editassign", form).then((res) => {
            if (res.data.data == 1) {
              Swal.fire("Success!", "Idea has been cancelled.", "success");
            } else {
              Swal.fire("something Worng!", "Danger");
            }
            this.getblogs();
          });
        }
      });
    },
    proceedblog(id, status) {
      Swal.fire({
        title: "Are you sure ?",
        text: "to proceed!",
        icon: "sucess",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, proceed!",
      }).then((result) => {
        if (result.isConfirmed) {
          var form = {
            id: id,
            status: status,
          };
          axios.post("/api/editassign", form).then((res) => {
            if (res.data.data == 1) {
              Swal.fire("Success!", "Idea has been sent.", "success");
            } else {
              Swal.fire("something Worng!", "Danger");
            }
            this.getblogs();
          });
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
        }
      });
    },
    getblogs() {
      const utcDate1 = new Date()
        .toISOString()
        .replace("T", " ")
        .replace("Z", "");
      console.log(utcDate1);
      this.form.product_id = this.Productvalue.map((a) => Number(a.id));

      this.form.currency_id = this.Currencyvalue.map((a) => Number(a.id));
      console.log(this.users, "this.users");
      this.form.assigned_user = this.users.id;
      this.form.assigned_status = 0;
      this.form.region_id = this.Countryvalue.map((a) => Number(a.id));
      console.log(this.Riskvalue);
      if (this.Riskvalue.length > 0) {
        this.form.risk = this.Riskvalue[0].id;
      } else {
        this.form.risk = "";
      }
      axios.post("/api/getassignedall", this.form).then((res) => {
        if (res.status == 200) {
          this.ideas = res.data.data;
          console.log(this.ideas);
        }

        this.form;
      });
    },
  },
  mounted() {
    const f = localStorage.getItem("user");
    this.users = JSON.parse(f);
    console.log(this.users);
    let date = new Date(); // Create a new date object with the current date and time
    date.setHours(0, 0, 0, 0); // Set the hours, minutes, seconds, and milliseconds to 0
    console.log(date);
    this.form.startdate = date.toISOString().replace("T", " ").replace("Z", "");
    this.getblogs();
    this.gotoeditblog();
  },
};
</script>
      <style scoped>
.mr-1 {
  margin-right: 10px;
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
.bing {
  height: calc(100vh - 163px);
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
.muldiv1 {
  width: 200px;
}
.muldiv2 {
  width: 115px;
}
.table > thead {
  border-bottom: 3px solid #d8d8d8;
}
.bio p {
  margin: 0px;
}
.Tit {
  font-weight: 800;
}
.Paraab {
  color: silver;
}
.bor-f {
  border-bottom: 3px solid #d8d8d8;
}
.prod-tag {
  width: 10%;
}
.badge {
  background: black;
  margin-right: 5px;
  margin-bottom: 0px;
}
</style>
      <style src="vue-multiselect/dist/vue-multiselect.css"></style>