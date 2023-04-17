<template>
    <div>
      <div class="w3-sidebar sidenav w3-bar-block" style="width: 17%">
        <Nav></Nav>
      </div>
      <!-- Page Content -->
      <div style="margin-left: 17%">
        <topnav></topnav>

        <div class="bing m-5">
          <h2 class="texth2">Past Investments Ideas</h2>
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
            <!-- <div class="muldiv">
              <label class="typo__label">Status</label>
              <multiselect
                v-model="Statusvalue"
                :options="Statusoptions"
                :multiple="true"
                :preserve-search="true"
                placeholder="Status"
                label="name"
                track-by="name"
              >
              </multiselect>
            </div> -->
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

                  <th scope="col">Risk</th>
                  <th scope="col">Manager</th>

                  <th scope="col">expiries at</th>
                  <th scope="col">Status</th>

                  <th scope="col" style="width: 5 %">Date</th>
                  <th scope="col"></th>
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

                  <td class="align-middle">
                    <button class="btn">{{ value.risk }}</button>
                  </td>
                  <td class="align-middle prod-tag">
                    <div>
                      <p class=" ">{{ value.assignedmanager_name }}</p>
                    </div>
                  </td>
                  <td class="align-middle prod-tag">
                    <div>
                      <p class=" ">{{ formatDate(value.expiry_at) }}</p>
                    </div>
                  </td>

                  <td class="align-middle prod-tag">
                    <div>
                      <button v-if="value.assigned_status == 1" class="pub">
                        Proceed
                      </button>
                      <button v-if="value.assigned_status == 2" class="draft">
                        Rejected
                      </button>
                      <button
                        v-else-if="value.assigned_status == 0"
                        class="draft"
                      >
                        Not yet decided
                      </button>
                    </div>
                  </td>
                  <!-- <td class="align-middle">
                    <button
                      class="btn btn-success mr-1 sd"
                      @click="goToView(value.blog_id)"

                     >
                     <div class="sddiv" v-if="value.comments.length>0">
                        <p class="sdp">{{ value.comments.length }}</p>

                     </div>
                      <font-awesome-icon :icon="['fas', 'message']" />
                    </button>
                  </td> -->
                  <td class="align-middle">{{ formatDate(value.created_at) }}</td>
                  <td class="align-middle">
                    <button
                      class="btn btn-success mr-1"
                      @click="goToView(value.blog_id)"
                    >
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
        Statusvalue: [ ],
        Statusoptions: [
          { name: "Proceed", id: "1" },
          { name: "Rejected", id: "2" },
          { name: "Not Yet decided", id: "0" },
        ],
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
      fo(idd) {
        const str = idd;
        const arr = str.split(",");
        return arr.length;
      },
      goToView(id) {
        this.$router.push(`/viewclient/${id}`);
      },
      formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleString();
      },
      deleteblog(id) {
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        }).then((result) => {
          if (result.isConfirmed) {
            var form = {
              blog_id: id,
            };
            axios.post("/api/deleteblog", form).then((res) => {
              if (res.data.data == 1) {
                Swal.fire("Deleted!", "Your blog has been deleted.", "success");
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

        this.form.region_id = this.Countryvalue.map((a) => Number(a.id));
        if (this.Riskvalue.length > 0) {
          this.form.risk = this.Riskvalue[0].id;
        } else {
          this.form.risk = "";
        }
        console.log(this.Statusvalue.length);
        if (this.Statusvalue.length > 0) {
          this.form.assigned_status = this.Statusvalue[0].id;
        }else {
          this.form.assigned_status = "";
        }
        this.form.assigned_status=[1,2]
        this.form.user_id = this.users.id;
        axios.post("/api/asdasd", this.form).then((res) => {
          if (res.status == 200) {
            this.ideas = res.data.data;
            console.log(this.Currencyoptions1);

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
    //   this.form.startdate = date.toISOString().replace("T", " ").replace("Z", "");
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
  .sd{
      position: relative;
  }
  .sddiv{
      width: 17px;
      height: 18px;
      position: absolute;
      top: 0px;
      left: 30px;
      background: #9d2121;
      border-radius: 21px;
  }
  .sdp{
          /* position: absolute; */
      /* top: 0px; */
      /* left: 30px; */
      /* background: red; */
      margin: 0;
      font-size: 13px;
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