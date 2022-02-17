<template>
  <div>
    <h1>Task details:</h1>
    <ul>
      <li>Name: {{ $store.state.tasks.find(task => task.id == $route.params.id).name }}</li>
      <li>ID: {{$route.params.id}}</li>
      <li>Due: {{ $store.state.tasks.find(task => task.id == $route.params.id).due }}</li>
      <li>Completed: {{ $store.state.tasks.find(task => task.id == $route.params.id).completed }}</li>
      <li>Created: {{ $store.state.tasks.find(task => task.id == $route.params.id).created }}</li>      
    </ul>
  </div>
</template>

<script>
export default {
  name: 'task',
}
</script>

<style>
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
  font-size: 1.25rem;
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
</style>