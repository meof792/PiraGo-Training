<template>
    <div>
        <input v-model="newTodo" @keyup.enter="submitTodo" placeholder="Add a todo" />
        <button @click="submitTodo">Add</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            newTodo: ''
        };
    },
    methods: {
        submitTodo() {
            if (this.newTodo.trim() !== '') {
                this.$emit('add-todo', this.newTodo);
                this.newTodo = '';
            }
        }
    }
};
</script>