<template>
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">Cita Aleatoria</h5>
        <p class="card-text" v-if="quote">{{ quote.quote }}</p>
        <p class="card-text"><small class="text-muted">{{ quote.author }}</small></p>
        <button class="btn btn-primary" @click="fetchRandomQuote">Nueva Cita</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        quote: null
      };
    },
    methods: {
      async fetchRandomQuote() {
        const response = await fetch('/api/quotes/random');
        this.quote = await response.json();
      }
    },
    mounted() {
      this.fetchRandomQuote();
    }
  };
  </script>