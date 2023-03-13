<template>
  <div>
    <div class="w3-sidebar sidenav w3-bar-block" style="width: 17%">
      <div class="logo">LOGO</div>

      <nav class="navabar">
        <ul class="nav-links">
          <li class="dashboard ">
            <a @click="$router.push('/creator')">
              <font-awesome-icon icon="fa-solid fa-house" />
              <span class="textspan"> Dashboard </span>
            </a>
          </li>
          <li class="dashboard active1">
            <a @click="$router.push('/createblog')">
              <font-awesome-icon icon="fa-solid fa-building" />
              <span class="textspan"> Blogs </span>
            </a>
          </li>
          <li class="dashboard">
            <a >
              <font-awesome-icon icon="fa-solid fa-users" />
              <span class="textspan"> Rms profiles </span>
            </a>
          </li>
          <li class="dashboard">
            <a >
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
      <div class="blogcre">
        <h1>Create Blog</h1>
        <div class="blog">
          <form class="uploadsign" id="file-form">
            <div class="form-floating mb-3">
              <input
                type="email"
                class="form-control"
                id="floatingInput"
                placeholder="name@example.com"
                v-model="form.title"
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


              ></textarea>
              <label for="floatingInput">Abstract</label>
            </div>
            <div class="form-floating mb-3">
              <textarea
                class="form-control"
                placeholder="Leave a comment here"
                id="floatingTextarea"
                style="height: 200px"
                v-model="form.Content"

              ></textarea>
              <label for="floatingInput">Content</label>
            </div>
            <div style="display: flex; justify-content: space-between ;margin-bottom: 20px;">
              <div class="muldiv">
                <label class="typo__label">Product Tags</label>
                <div class="oi">
                    <multiselect
                  v-model="Productvalue"
                  :options="Productoptions"
                  :multiple="true"
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
                  v-model="Currencyvalue"
                  :options="Currencyoptions"
                  :multiple="true"
                  :preserve-search="true"
                  placeholder="Currency"
                  label="name"
                  track-by="id"
                >
                </multiselect>
              </div>
            </div>
            <div style="display: flex; justify-content: space-between ;margin-bottom: 20px;">
              <div class="muldiv">
                <label class="typo__label">Country</label>
                <multiselect
                  v-model="Countryvalue"
                  :options="Countryoptions"
                  :multiple="true"
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
                  v-model="Regionvalue"
                  :options="Regionoptions"
                  :multiple="true"
                  :preserve-search="true"
                  placeholder="Currency"
                  label="name"
                  track-by="id"
                >
                </multiselect>
              </div>
            </div>
            <div style="display: flex; justify-content: space-between;margin-bottom: 20px;">
              <div class="muldiv">
                <label class="typo__label">Risk</label>
                <multiselect
                  v-model="Riskvalue"
                  :options="Riskoptions"
                  :preserve-search="true"
                  placeholder="risk"
                  label="name"
                  track-by="name"

                >
                </multiselect>
              </div>
              <div class="muldiv">
                <label class="typo__label">expiry date</label>
                <VueDatePicker v-model="form.expiry_at" placeholder="Start Typing ..." text-input />

              </div>
            </div>
          </form>
          <div>
            <button class="btn  btn-dark   m-3" @click="Savepublish(true)"> Publish</button>
            <button class="btn  btn-dark   m-3" @click="Savepublish(false)"> Save Draft</button>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>
    <script>
import Select from "datatables.net-select";
import Multiselect from "vue-multiselect";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {
  components: {
    Multiselect,
    VueDatePicker
  },
  data() {
    return {
        form:{
            title:'',
            abstract:"",
            risk:"",
            creator_id:"",
            Content:'',
            expiry_at:null
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
  methods:{
    Savepublish(a){
        console.log(this.form);
        const utcDate1 = new Date(this.form.expiry_at);
        utcDate1.toISOString();
        this.form.product_id= JSON.stringify( this.Productvalue.map(a => a.id))
        this.form.currency_id=JSON.stringify(this.Currencyvalue.map(a => a.id))
        this.form.region_id=JSON.stringify(this.Countryvalue.map(a => a.id))
        this.form.country_id=JSON.stringify(this.Regionvalue.map(a => a.id))
        this.form.risk=this.Riskvalue.name;
        this.form.creator_id=3
        this.form.expiry_at=utcDate1
        axios
        .post("/api/createblog", this.form)
        .then((res) => {
            console.log(this.form);

        })
    }
  }
};
</script>
    <style scoped>
.muldiv {
  width: 45%;
}
.oi{

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
