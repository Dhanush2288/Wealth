<template>
    <div>
      <div class="w3-sidebar sidenav w3-bar-block" style="width: 17%">
        <Nav></Nav>
      </div>
      <!-- Page Content -->
      <div style="margin-left: 17%">
        <topnav></topnav>

        <div class="bing m-5">
          <h2 class="texth2">Clients</h2>

          <div class="shadow p-3 bg-white rounded">
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col" style="width: 15%">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Preferred Product</th>
                  <th scope="col">Preferred currency</th>
                  <th scope="col">Preferred Risk</th>
                  <th scope="col">MAx limit</th>
                  <th scope="col">Assigned</th>
                  <th scope="col" style="width: 5 %">Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(value, index) in usersall"
                  class="bor-f"
                  v-bind:key="index"
                >
                  <th scope="row">{{ index + 1 }}</th>
                  <td>
                    <div class="bio">
                      <p class="Tit">{{ value.name }}</p>
                      <p class="Paraab">
                        {{ value.abstract }}
                      </p>
                    </div>
                  </td>
                  <td class="align-middle prod-tag">
                    <div>
                      <p class="">{{ value.email }}</p>
                    </div>
                  </td>
                  <!-- <td class="align-middle prod-tag">
                      <div>
                        <p class="">{{ value.product_name }}</p>
                      </div>
                    </td> -->
                  <td>{{ value.product_name }}</td>
                  <td>{{ value.currency_name }}</td>
                  <td>{{ value.risk_rating }}</td>
                  <td>{{ value.maxrange }}</td>

                  <td class="align-middle prod-tag">
                    <div>
                      <button class="assignedbtn">2 Assigned</button>
                    </div>
                  </td>

                  <td class="align-middle">{{ formatDate(value.created_at) }}</td>
                  <td class="align-middle">
                    <button
                      class="btn btn-success mr-1"
                      @click="goToView(value.users__id)"
                    >
                      View
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
        ideas: [],
        usersall: [],
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
        Statusvalue: [],
        Statusoptions: [
          { name: "Published", id: "1" },
          { name: "Draft", id: "0" },
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
      gotoeditblog(id) {
        this.$router.push(`/edit/${id}`);
      },
      goToView(id) {
        this.$router.push(`/viewrmt/${id}`);
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
      getblogs() {
        var form = {
          roleid: 2,
        };

        axios.post("/api/assignedclients", form).then((res) => {
          if (res.status == 200) {
            this.usersall = res.data.data;
            console.log(this.usersall);
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
    },
    mounted() {
      let date = new Date(); // Create a new date object with the current date and time
      date.setHours(0, 0, 0, 0); // Set the hours, minutes, seconds, and milliseconds to 0
      console.log(date);
      this.form.startdate = date.toISOString().replace("T", " ").replace("Z", "");
      this.getblogs();
      this.gotoeditblog1();
    },
  };
  </script>
        <style scoped>
  .mr-1 {
    margin-right: 10px;
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

