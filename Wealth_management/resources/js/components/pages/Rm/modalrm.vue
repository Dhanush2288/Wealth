<template>
  <div class="modal" :class="{ 'is-active': isActive }">
    <div class="modal-background"></div>
    <div class="modal-content">
      <div class="top">
        <button
          class="modal-close btn btn-dark"
          aria-label="close"
          @click="hideModal"
        >
          <font-awesome-icon icon="fa-solid fa-close" />
        </button>
        <div>
          <h4>Clients</h4>
        </div>
      </div>
      <p v-if="this.showall">No recommedation found so we are showing all clients</p>
      <table class="user-table" style="margin: 10px">
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Preferred Product</th>
            <th>Preferred Currency</th>
            <th>Preferred Risk</th>
            <th>Max investment</th>

            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(value, index) in profiledatas"
            class="shadow-sm bg-white rounded"
            v-bind:key="index"
          >
            <td>
              <img
              :src="avatarUrl"
                alt="User Image"
                class="imgsrc"
              />
            </td>
            <td>{{ value.name }}</td>
            <td>{{ value.email }}</td>
            <td>{{ value.product_name }}</td>
            <td>{{ value.currency_name }}</td>
            <td>{{ value.risk_rating }}</td>
            <td>{{ value.maxrange }}</td>
            <td>
              <button class="btn btn-dark" v-on:click="assign(value.user_id)">
                Assign
              </button>
            </td>
          </tr>

          <!-- Additional rows here -->
        </tbody>
      </table>
    </div>
  </div>
</template>

    <script>
export default {
  name: "CustomModal",

  data() {
    return {itemId:null,
      isActive: false,
      profiledatas: [],
      showall:false,
      imagestype: ["Aneka", "Angel", "Scooter", "Charlie", "Lucy", "Cuddles"],

    };
  },
  computed: {
    avatarUrl() {
      const type =
        this.imagestype[Math.floor(Math.random() * this.imagestype.length)];
      const baseUrl = `https://api.dicebear.com/6.x/big-smile/svg?seed=${type}&backgroundColor=c0aede&backgroundType=gradientLinear&flip=true`;

      return baseUrl;
    },
  },
  methods: {
    showModal() {
      this.isActive = true;
    },
    hideModal() {
      this.isActive = false;
    },
    assign(id) {
      this.$emit("message-sent", id);
      this.hideModal();
    },
    profile() {
        var form={
            blog_id: this.itemId
        }
      axios.post("/api/recommendUsers", form).then((res) => {
        if (res.status == 200) {
            if(res.data.success){
                this.profiledatas = res.data.data
            }else{
                var foorm={
                    roleid:4
                }
                axios.post("/api/userpreall", foorm).then((res) => {
                    if (res.status == 200) {
                        this.showall=true
                        this.profiledatas = res.data.data

                    }

                })
            }
        //   this.profiledatas = res.data.data;
        }
      });
    },
  },
  mounted() {
    this.itemId = this.$route.params.id;
console.log(this.itemId,'this.itemId');
    this.profile();
  },
};
</script>

    <style>
.user-list {
  list-style: none;
  padding: 0;
}

.user-list li {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.user-list img {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  margin-right: 20px;
}

.user-list .user-details {
  flex: 1;
}

.user-list h3 {
  margin: 0;
  font-size: 20px;
}

.user-list p {
  margin: 0;
  font-size: 16px;
  color: #555;
}
.modal {
  display: none;
}

.modal.is-active {
  display: flex;
}

.modal-background {
  background-color: rgba(0, 0, 0, 0.5);
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.modal-content {
  background-color: white;
  margin: auto;
  max-width: 75%;
  max-height: 80%;
  overflow: auto;
  position: relative;
  padding: 2rem;
}

.modal-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  cursor: pointer;
  z-index: 20;
}
.imgsrc {
  /* width: 100px; */
  width: 52px;
  border-radius: 66px;
  height: 52px;
}
</style>
