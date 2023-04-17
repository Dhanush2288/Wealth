<template>
    <div>
      <div class="logo">LOGO</div>

      <nav class="navabar">
        <ul class="nav-links">
          <li class="dashboard">
            <a @click="$router.push('/client')">
              <font-awesome-icon icon="fa-solid fa-house" />
              <span class="textspan"> Dashboard </span>
            </a>
          </li>
          <li class="Blogs">
            <a @click="$router.push('/viewassigned')">
              <font-awesome-icon icon="fa-solid fa-building" />
              <span class="textspan"> Investments </span>
            </a>
          </li>
          <li class="PastAssigned">
            <a @click="$router.push('/pastassigned')">
              <font-awesome-icon icon="fa-solid fa-building" />
              <span class="textspan"> History </span>
            </a>
          </li>
          <li class="profiles">
            <a @click="$router.push('/Profilesclient')">
              <font-awesome-icon icon="fa-solid fa-users" />
              <span class="textspan"> Rms profiles </span>
            </a>
          </li>
          <li class="Profile">
            <a @click="$router.push('/clientprofile')">
              <font-awesome-icon icon=" fa-solid fa-user" />
              <span class="textspan"> Profile </span>
            </a>
          </li>
          <li class="Log">
            <a @click="logout()">
              <i class="fa fa-sign-out"></i>
              <span class="textspan"> Log out </span></a
            >
          </li>
        </ul>
      </nav>
    </div>
  </template>
  <script>
  import $ from 'jquery'

   export default {
    data() {
      return {};
    },
    methods: {
      add(link) {
        if (link == "client") {
          console.log(link);
          $(".dashboard").addClass("active11").siblings().removeClass("active11");
        } else if (link === "viewassigned") {
          $(".Blogs").addClass("active11").siblings().removeClass("active11");
        }
        else if (link === "edit" || link === "viewclient" || link === "viewall") {
          $(".Blogs").addClass("active11").siblings().removeClass("active11");
        }
        else if (link === "Profilesclient") {
          $(".profiles").addClass("active11").siblings().removeClass("active11");
        }
        else if (link === "clientprofile") {
          $(".Profile").addClass("active11").siblings().removeClass("active11");
        }
        else if (link === "pastassigned") {
          $(".PastAssigned").addClass("active11").siblings().removeClass("active11");
        }
         else {
          $(".dashboard").addClass("active11").siblings().removeClass("active11");
        }
        $(document).on("click", "ul li", function () {
          $(this).addClass("active11").siblings().removeClass("active11");
        });
      },
      logout() {
        localStorage.removeItem("user");
        this.$router.push("/login");
      },
    },
    mounted() {
      console.log(this.$route.name);
      this.add(this.$route.name);
    },
  };
  </script>
  <style scoped>
  .muldiv {
    width: 45%;
  }
  .oi {
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
  .active11 {
    padding-bottom: 3px;
    background: #e7e2f8;
    color: #685998;
    border-radius: 5px;
    margin-right: 10px;
  }
  .active11 .textspan {
    /* color: black; */
    font-weight: 700;
    color: #533f8f;
  }
  .logo {
    font-weight: 700;
    font-size: 35px;
    font-family: "Poppins", sans-serif;
    margin: 10px;
  }
  </style>
        <style src="vue-multiselect/dist/vue-multiselect.css"></style>
