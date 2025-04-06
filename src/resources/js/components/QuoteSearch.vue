<template>
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">Buscar por ID</h5>
        <input type="number" v-model="searchId" class="form-control mb-2" placeholder="ID de la cita">
        <button class="btn btn-success" @click="searchQuote">Buscar</button>
        <div v-if="quote">
          <p class="mt-3">{{ quote.quote }}</p>
          <p><small class="text-muted">{{ quote.author }}</small></p>
        </div>
        <div v-if="error" class="text-danger mt-2">
          {{ error }}
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        searchId: null,
        quote: null,
        error: null
      };
    },
    methods: {
      async searchQuote() {
        this.error = null;
        const response = await fetch(`/api/quotes/${this.searchId}`);
        if (response.ok) {
          this.quote = await response.json();
        } else {
          this.error = "Cita no encontrada";
        }
      }
    }
  };
  </script>