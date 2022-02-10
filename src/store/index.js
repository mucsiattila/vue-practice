import { createStore } from "vuex"
import axios from "axios"

export default createStore({
  state: {
    tasks: [],
  },
  getters: {},
  mutations: {
    setTasks: (state, tasks) => state.tasks = tasks
  },
  actions: {
    getTasks: ({ commit }) => {
      console.log("Taskok lekérése")
      axios.get(process.env.VUE_APP_API_URL)
        .then(response => commit('setTasks', response.data))
        .catch(err => console.log(err))
    }
  },
  modules: {},
});
