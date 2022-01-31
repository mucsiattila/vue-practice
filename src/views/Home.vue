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
      title: 'Ez a Home oldal',
      tasks: [
        {
          id: 1,
          name: 'Első teszt feladat',
          completed: false,
          due: '2022-02-10'
        },
        {
          id: 2,
          name: 'Második feladat',
          completed: true,
          due: '2022-02-15'
        },
        {
          id: 3,
          name: 'Hármas feladat',
          completed: false,
          due: '2022-02-20'
        },
        {
          id: 4,
          name: 'Négyes feladat',
          completed: false,
          due: '2022-02-25'
        }
      ],
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
  .completed {
    text-decoration: line-through;
  }
</style>