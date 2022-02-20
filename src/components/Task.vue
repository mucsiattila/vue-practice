<template>
  <div>
    <li
      :class="{ completed: task.completed }"
      v-show="!task.completed || showCompleted"
    >
      <div class="row">
        <span class="column small-1">
          <input
            @click="changeCompleted()"
            type="checkbox"
            :checked="task.completed"
          />
        </span>
        <span class="column small-8">{{ task.name }}</span>
        <router-link
          :to="'/tasks/' + task.id"
          class="column small-1 text-right mini"
        >
          <i class="fi-eye"></i>
        </router-link>
        <i
          @click="editTask()"
          class="fi-pencil column small-1 text-right mini"
        ></i>
        <i
          @click="deleteTask()"
          class="fi-trash column small-1 text-right mini"
        ></i>
      </div>
      <div class="row mini">
        <span class="due column small-6">
          <i class="fi-flag"></i>
          {{ task.due }}
        </span>
        <span
          :class="{ created: task.created }"
          class="column small-6 text-right"
        >
          <i class="fi-calendar"></i>
          {{ task.created }}
        </span>
      </div>
    </li>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: {
    showCompleted: { type: Boolean },
    task: {
      type: Object,
      default: function () {
        return { id: 0 };
      },
      required: true,
    },
  },
  methods: {
    changeCompleted() {
      this.$emit("changeCompleted", this.task);
    },
    editTask() {
      this.$emit("editIconClicked", this.task);
    },
    deleteTask() {
      console.log("Delete: " + this.task.id);
      axios
        .delete(process.env.VUE_APP_API_URL, { data: this.task })
        .then((response) => (this.$store.state.tasks = response.data))
        .catch((err) => console.log(err));
    },
  },
};
</script>

<style>
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
  border-bottom: 1px solid dodgerblue;
}
li:hover {
  background: dodgerblue;
  color: white;
  transition: 0.1s;
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
.mini {
  font-size: 0.85rem;
}
</style>
