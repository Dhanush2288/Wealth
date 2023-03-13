<template>
  <div>
    <div class="w3-sidebar sidenav w3-bar-block" style="width: 17%">
      <div class="logo">LOGO</div>

      <nav class="navabar">
        <ul class="nav-links">
          <li class="dashboard active1">
            <a @click="$router.push('/register')">
              <font-awesome-icon icon="fa-solid fa-house" />
              <span class="textspan"> Dashboard </span>
            </a>
          </li>
          <li class="dashboard">
            <a @click="$router.push('/register')">
              <font-awesome-icon icon="fa-solid fa-building" />
              <span class="textspan"> Assigned </span>
            </a>
          </li>
          <li class="dashboard">
            <a @click="$router.push('/register')">
              <font-awesome-icon icon="fa-solid fa-users" />
              <span class="textspan"> Clent profiles </span>
            </a>
          </li>
          <li class="dashboard">
            <a @click="$router.push('/register')">
              <font-awesome-icon icon=" fa-solid fa-user" />
              <span class="textspan"> Profile </span>
            </a>
          </li>
          <!-- <li class="dashboard">
            <a href="http://localhost:4000/contact">
              <i class="fa fa-phone"></i>
              <span class="textspan"> Contact us </span></a
            >
          </li> -->
        </ul>
      </nav>
    </div>
    <!-- Page Content -->
    <div style="margin-left: 17%">
      <div class="topnav">
        <div class="profilee">
          <img class="as" src="image\1606902272profile.jpeg" alt="" />
          <h5 class="h5sd">Hi Dhanush kodi</h5>
        </div>
      </div>
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
            <label class="typo__label">Country</label>
            <multiselect
              v-model="Countryvalue"
              :options="Countryoptions"
              :multiple="true"
              :preserve-search="true"
              placeholder="Country"
              label="name"
              track-by="name"
            >
            </multiselect>
          </div>
          <div class="muldiv1">
            <Button class="btn btn-lg btn-dark w-100 mt-3"> Search</Button>
          </div>
        </div>
        <div class="shadow p-3 bg-white rounded">
          <table class="table table-borderless">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 30%">Investment Idea</th>
                <th scope="col">Product</th>
                <th scope="col">Risk</th>
                <th scope="col">Date</th>
                <th scope="col">Creator</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr class="bor-f">
                <th scope="row">1</th>
                <td>
                  <div class="bio">
                    <p class="Tit">Bitcoin Bump</p>
                    <p class="Paraab">
                      An abstract class can be considered as a blueprint for
                      other classes.
                    </p>
                  </div>
                </td>
                <td class="align-middle prod-tag">
                  <div>
                    <p class="badge badge-info">Equity</p>
                    <p class="badge badge-info">Equity</p>
                    <p class="badge badge-info">Equity</p>
                    <p class="badge badge-info">Equity</p>
                    <p class="badge badge-info">Equity</p>
                  </div>
                </td>
                <td class="align-middle"><button class="btn">5</button></td>
                <td class="align-middle">@mdo</td>
                <td class="align-middle">@mdo</td>

                <td class="align-middle">
                  <button class="btn btn-success mr-1">View</button>
                  <button class="btn btn-danger">
                    <font-awesome-icon icon=" fa-solid fa-trash" />
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

export default {
  components: {
    Multiselect,
  },
  data() {
    return {
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
      Countryvalue: [],
      Countryoptions: [
        { name: "India", id: "1" },
        { name: "UK", id: "2" },
        { name: "US", id: "2" },
      ],
      columns: [
        {
          field: "",
          key: "a",
          title: "#",
          align: "center",
        },
        { field: "name", key: "b", title: "Name", align: "center" },
        { field: "date", key: "c", title: "Date", align: "left" },
        { field: "hobby", key: "d", title: "Hobby", align: "left" },
        { field: "address", key: "e", title: "Address", width: "" },
      ],
      rows: [
        { id: 1, name: "John", age: 20, createdAt: "", score: 0.03343 },
        {
          id: 2,
          name: "Jane",
          age: 24,
          createdAt: "2011-10-31",
          score: 0.03343,
        },
        {
          id: 3,
          name: "Susan",
          age: 16,
          createdAt: "2011-10-30",
          score: 0.03343,
        },
        {
          id: 4,
          name: "Chris",
          age: 55,
          createdAt: "2011-10-11",
          score: 0.03343,
        },
        {
          id: 5,
          name: "Dan",
          age: 40,
          createdAt: "2011-10-21",
          score: 0.03343,
        },
        {
          id: 6,
          name: "John",
          age: 20,
          createdAt: "2011-10-31",
          score: 0.03343,
        },
      ],
    };
  },
};
</script>
<style scoped>
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
  width: 250px;
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
  width: 17%;
}
.badge {
  background: black;
  margin-right: 5px;
  margin-bottom: 0px;
}
</style>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

