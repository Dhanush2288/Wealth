import { createStore } from 'vuex'



const store = createStore({
  state: {
    currentUser: null
  },
  mutations: {
    setCurrentUser(state, user) {
      state.currentUser = user
    }
  },
  actions: {
    login({ commit }, user) {
      // Perform login API call and set currentUser state
      commit('setCurrentUser', user)
    },
    logout({ commit }) {
      // Perform logout API call and clear currentUser state
      commit('setCurrentUser', null)
    }
  },
  getters: {
    isAuthenticated(state) {
      return !!state.currentUser
    },
    infor(state){
        return state.currentUser

    }
  }
})
export default store
