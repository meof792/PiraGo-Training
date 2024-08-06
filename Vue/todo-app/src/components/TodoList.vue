<template>
    <div>
        <TodoItems v-for="(todo, index) in todos" :key="index" :todo="todo"
            @toggle-todo="() => $emit('toggle-todo', index)" @remove-todo="() => $emit('remove-todo', index)" />
    </div>
</template>

<script>
import TodoItems from './TodoItems.vue';

export default {
    props: ['todos'],
    components: {
        TodoItems
    }
};
</script>