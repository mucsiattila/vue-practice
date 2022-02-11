<template>
  <div>
    <h1>Stats</h1>
    <div class="row">
      <div class="column small-5 w1">
        <h2>{{ $store.state.tasks.length }}</h2>
        <i class="fi-list-thumbnails">Összes</i>
      </div>
      <div class="column small-5 w2">
        <h2>{{ $store.state.tasks.filter(task => task.completed).length }}</h2>
        <i class="fi-list-thumbnails">Kész</i>
      </div>
      <div class="column small-5 w3">
        <h2>{{ $store.state.tasks.filter(task => !task.completed).length }}</h2>
        <i class="fi-list-thumbnails">Nyitva</i>
      </div>
      <div class="column small-5 w4">
        <h2>{{ overdueTasks.length }}</h2>
        <i class="fi-list-thumbnails">Lejárt</i>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: "Stats",
  computed: mapGetters(['overdueTasks'])
}
</script>

<style scoped>
h1{
  background: dodgerblue;
  color: white;
  padding: 1rem;
  text-align: center;
}
div.row div.column {
  margin: 1rem;
  padding: 1rem;
  color: white;
}
.w1 {
  background: slateblue;
}
.w2 {
  background: cadetblue;
}
.w3 {
  background: indianred;
}
.w4 {
  background: darkcyan;
}
</style>