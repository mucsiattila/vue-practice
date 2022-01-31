<template>
  <div>
    <h1>Home</h1>
    <ul>
      <li v-for = "task in tasks" :key = "task.id" :class = "{completed: task.completed}">
        <input @click="changeCompleted(task.id)" type = "checkbox" :checked = task.completed>
        {{task.name}} - {{task.due}}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'home',

  components: {

  },

  data() {
    return {
      tasks: [],
    }
  },

  computed: {

  },

  created() {

  },

  methods: {
    changeCompleted(id) {
      let task = this.tasks.find(task => task.id == id)
      task.completed = !task.completed
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

</style>