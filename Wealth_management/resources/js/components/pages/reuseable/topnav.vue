<template>
  <div>
    <div class="topnav">
      <div class="profilee">
        <img class="as" :src=avatarUrl alt="" />
        <h5 class="h5sd">Hi {{ this.users ? this.users.name : "" }}</h5>
        <div class="togglebtnlog">
          <button
            @click="isDropdownOpen = !isDropdownOpen"
            class="buttontoggle"
          >
            <font-awesome-icon :icon="['fas', 'ellipsis-vertical']" />
          </button>
          <ul class="btnul" v-show="isDropdownOpen">
            <!-- Dropdown menu items here -->
            <li>
              <button class="btn  bttonlog" @click="logout()">
                Logout
              </button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import $ from "jquery";

export default {
  data() {
    return {
      isDropdownOpen: false,
      users: null,
      avatar:null,
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
    logout() {
      localStorage.removeItem("user");
      this.$router.push("/login");
    },
  },
  mounted() {
    const f = localStorage.getItem("user");
    this.users = JSON.parse(f);
    this.avatar=localStorage.getItem("avatar")
  },
};
</script>
<style scoped>
.togglebtnlog {
  position: relative;
  display: inherit;
}
.buttontoggle {
  margin: auto;
  border: none;
}
.btnul {
  position: absolute;
  top: 41px;
  list-style: none;
  background: white;
  padding: 0px;
}
.profilee {
  display: flex;
  width: 264px;
  float: right;
  margin-top: 13px;
}
.bttonlog{
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    font-family: 'Poppins';
    border: none;
    padding: 5px 25px;
    font-weight: 600;
}
.h5sd {
  display: inline;
  margin: auto 5px;
  font-size: 14px;
  font-family: "Poppins";
  font-weight: 600;
}
.as {
  width: 52px;
  border-radius: 66px;
  height: 52px;
}
.topnav {
  height: 73px;
  background: #f4f4f8;
}
</style>
