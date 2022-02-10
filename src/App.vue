<template>
  <div id="nav">
    <router-link to="/">Home</router-link>
    <router-link to="/stats">Stats</router-link>
    <router-link to="/login" v-if="!loggedIn">Login</router-link>
    <router-link to="/logout" v-if="loggedIn">Logout</router-link>
  </div>
  <router-view />
</template>


<script>
export default {
  name: 'App',

  data() {
    return {
      loggedIn : false
    }
  },
  
  created() {
    this.$store.dispatch('getTasks')
  },
}
</script>


<style>
@import url('https://fonts.googleapis.com/css?family=Quicksand:500');
@import url('./assets/foundation.min.css');
@import url('./assets/foundation-icons.css');

#app {
  font-family: 'Quicksand', sans-serif;
}
#nav {
  text-align: center;
  padding-top: 20px;
}
#nav a {
  color: #333;
  padding: 1rem;
  font-size: 25px;
  text-decoration: none;
}
</style>

