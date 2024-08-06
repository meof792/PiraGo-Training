<template>
    <div>
        <input type="checkbox" :checked="todo.completed" @change="$emit('toggle-todo')" />
        <span :style="{ textDecoration: todo.completed ? 'line-through' : 'none' }">{{ todo.text }}</span>
        <button @click="$emit('remove-todo')">Remove</button>
    </div>
</template>

<script>
export default {
    props: ['todo']
};
</script>