<template>
  <div>
    <h1>Home</h1>
    <form class="row">
      <input type="text" v-model="task" placeholder="Add new task" class="column small-7">
      <input type="date" @blur="addTask" v-model="due" class="column small-5" />
    </form>
    <div class="row">
      <div class="column small-12">
        <div class="row">
          <i class="fi-check column small-2" @click="toggleCompleted" title="Kész feladatok elrejtése / mutatása"></i>
          <div class="column small-10 text-right">
            <i class="fi-checkbox column small-4" title="Nyitott">{{ open }}</i>
            <i class="fi-flag column small-4" title="Lejárt">{{ overdueTasks.length }}</i>
          </div>
        </div>
      </div>
    </div>
    <ul>
      <task v-for = "task in tasks" :key = "task.id" :task="task" :showCompleted="showCompleted" />
    </ul>
  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
import Task from "@/components/Task.vue"


export default {
  name: 'home',

  components: {
    Task
  },

  data() {
    return {
      showCompleted : true,
      task : '',
      due : (new Date((new Date).setDate((new Date).getDate() + 3))).toISOString().split('T')[0]
    }
  },

  computed: {
    ...mapGetters(['overdueTasks']),
    open : function() {
      return this.tasks.filter(task => !task.completed).length
    },
    tasks: function() {
      return this.$store.state.tasks
    }
  },

  methods: {
    addTask() {
      const task = {
        name: this.task,
        due: this.due,
        completed: false
      }
      axios.post(process.env.VUE_APP_API_URL, task)
        .then(response => {
          this.tasks.push(response.data)
          this.task = ''
        })
        .catch(err => console.log(err))
    },
    toggleCompleted() {
      this.showCompleted = !this.showCompleted
    }
  }
}
</script>

<style scoped>  
h1 {
  background: dodgerblue;
  color: white;
  padding: 1rem;
  text-align: center;
}
input[type=text] {
  font-size: 1.5rem;
  height: 2.5rem;
}
</style>