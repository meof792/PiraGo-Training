<template>
  <div id="app">
    <h1>Todo App</h1>
    <TodoAdd @add-todo="addTodo" />
    <TodoList :todos="todos" @toggle-todo="toggleTodo" @remove-todo="removeTodo" />
  </div>
</template>

<script>
import TodoAdd from './components/TodoAdd.vue';
import TodoList from './components/TodoList.vue';

export default {
  components: {
    TodoAdd,
    TodoList
  },
  data() {
    return {
      todos: JSON.parse(localStorage.getItem('todos')) || []
    };
  },
  methods: {
    addTodo(newTodo) {
      this.todos.push({ text: newTodo, completed: false });
      this.saveTodos();
    },
    toggleTodo(index) {
      this.todos[index].completed = !this.todos[index].completed;
      this.saveTodos();
    },
    removeTodo(index) {
      this.todos.splice(index, 1);
      this.saveTodos();
    },
    saveTodos() {
      localStorage.setItem('todos', JSON.stringify(this.todos));
    }
  }
};
</script>
<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  text-align: center;
  margin-top: 60px;
}

button {
  margin-left: 10px;
}

input[type="checkbox"] {
  margin-right: 10px;
}
</style>
