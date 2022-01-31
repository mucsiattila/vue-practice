<template>
  <div id="nav">
    <router-link to="/">Home</router-link>
    <router-link to="/about">About</router-link>
  </div>
  <router-view />
</template>

<style scoped>

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