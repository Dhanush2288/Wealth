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
          <h4>Managers</h4>
        </div>
      </div>
      <table class="user-table" style="margin: 10px">
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
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
                src="image\1606902272profile.jpeg"
                alt="User Image"
                class="imgsrc"
              />
            </td>
            <td>{{ value.name }}</td>
            <td>{{ value.email }}</td>
            <td>
              <button class="btn btn-dark" v-on:click="assign(value.id)">
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
    return {
      isActive: false,
      profiledatas: [],
    };
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
this.hideModal()
    },
    profile() {
        var form={
            roleid:2
        }
      axios.post("/api/users", form).then((res) => {
        if (res.status == 200) {
          this.profiledatas = res.data.data;
        }
      });
    },
  },
  mounted() {
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
  max-width: 40%;
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
