<template>
  <div>
    <h1>Home</h1>
    <form>
      <input type="text" v-model="task" placeholder="Add new task">
      <input type="date" @blur="addTask" v-model="due">
    </form>
    <ul>
      <li v-for = "task in tasks" :key = "task.id" :class = "{completed: task.completed}">
        <input @click="changeCompleted(task.id)" type = "checkbox" :checked = task.completed>
        {{task.name}} - 
        <span class="due">{{task.due}}</span>
        <span :class="{created: task.created}">{{task.created}}</span>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'home',

  components: {

  },

  data() {
    return {
      task: '',
      tasks: [],
      due: (new Date((new Date).setDate((new Date).getDate() + 3))).toISOString().split('T')[0]
    }
  },


  created() {
    axios.get(process.env.VUE_APP_API_URL)
      .then(response => this.tasks = response.data)
      .catch(err => console.log(err))

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

form {
  display: flex;
}

input[type=text] {
  flex-grow: 3;
  font-size: 1.5rem;
  height: 2.5rem;
}

.created {
  font-size: .75rem;
  background: silver;
  color: beige;
  padding: .2rem;
}

</style>