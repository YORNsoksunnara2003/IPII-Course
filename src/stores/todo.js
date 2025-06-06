import { defineStore } from "pinia";
import axios from "axios";
export const useTodoStore = defineStore("todo", {
  state: () => ({
    todos: [],
  }),
 getters: {
    countTodos: (state) => state.todos.length,
    countPending: (state) => state.todos.filter(todo => todo.completedAt == null).length, // count pending only
  },
  actions: {
  async fetchTodos() {
    try {
      const response = await axios.get('http://localhost:3100/tasks');
      this.todos = response.data;
    } catch (error) {
      console.error('Failed to fetch todos:', error);
    }
  },
  toggleStatus(id) {
      const foundIndex = this.todos.findIndex((t) => t.id === id);
      if (foundIndex >= 0) {
        const todo = this.todos[foundIndex];
        todo.completedAt = todo.completedAt ? null : new Date().toISOString();
      }
    },
  async addTodo(name) {
    try {
      const response = await axios.post('http://localhost:3100/tasks', {
        name,
        description: "description",
      }); 
      this.todos.push(response.data);
    } catch (error) {
      console.error("Failed to add todo:", error);
    }
  },
async clearAll() {
  try {
    const now = new Date().toISOString();
    const updatePromises = this.todos.map(todo =>
      axios.delete(`http://localhost:3100/tasks/${todo.id}`, {
        deletedAt: now
      })
    );
    await Promise.all(updatePromises);
    this.todos = []; // Remove from frontend store
  } catch (error) {
    console.error("Failed to soft delete all todos:", error);
  }
}

}

});
