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
      <li v-for = "task in tasks" :key = "task.id" :class = "{completed: task.completed}" v-show="!task.completed || showCompleted">
        <div class="row">
          <span class="column small-1">
            <input @click="changeCompleted(task.id)" type = "checkbox" :checked = task.completed>
          </span>
          <span class="column small-8">{{ task.name }}</span>
          <router-link :to="'/tasks/' + task.id" class="column small-1 text-right mini">
            <i class="fi-eye"></i>
          </router-link>
          <i @click="editTask(task.id)" class="fi-pencil column small-1 text-right mini"></i>
          <i @click="deleteTask(task.id)" class="fi-trash column small-1 text-right mini"></i>
        </div>
        <div class="row mini">
          <span class="due column small-6">
            <i class="fi-flag"></i>
            {{ task.due }}
          </span>
          <span :class="{created: task.created}" class="column small-6 text-right">
            <i class="fi-calendar"></i>
            {{ task.created }}
          </span>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
  name: 'home',

  components: {

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
    changeCompleted(id) {
      let task = this.tasks.find(task => task.id == id)
      task.completed = !task.completed
      axios.put(process.env.VUE_APP_API_URL, task)
        .then(response => console.log(response.data))
        .catch(err => console.log(err))
    },
    editTask(id) {
      let task = this.tasks.find(task => task.id == id)
      this.task = task.name
      this.due = task.due
    },
    toggleCompleted() {
      this.showCompleted = !this.showCompleted
    },
    deleteTask(id) {
      let task = this.tasks.find(task => task.id == id)
      console.log("Delete: " + task.id)
      axios.delete(process.env.VUE_APP_API_URL, {data: task})
        .then(response => console.log(response.data))
        .catch(err => console.log(err))
    }
  },
}
</script>

<style scoped>  
h1 {
  background: dodgerblue;
  color: white;
  padding: 1rem;
  text-align: center;
}
ul {
  list-style: none;
  margin: 0;
  padding: 0;
  font-size: 1.5rem;
  color: #333;
}
li {
  margin: 0 1rem;
  padding: 1rem;
  border-bottom:  1px solid dodgerblue;
}
li:hover {
  background: dodgerblue;
  color: white;
  transition: .1s;
}
.completed {
  text-decoration: line-through;
  color: dodgerblue;
  border: 0;
}
.completed:hover {
  background: white;
  color: dodgerblue;
}
input[type=text] {
  font-size: 1.5rem;
  height: 2.5rem;
}
.mini {
  font-size: .85rem;}
</style>