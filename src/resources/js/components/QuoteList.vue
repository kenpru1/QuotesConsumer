<template>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Texto</th>
            <th>Autor</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="quote in quotes" :key="quote.id">
            <td>{{ quote.id }}</td>
            <td>{{ quote.quote }}</td>
            <td>{{ quote.author }}</td>
          </tr>
        </tbody>
      </table>
      <nav>
        <ul class="pagination">
          <li class="page-item" :class="{disabled: currentPage === 1}">
            <a class="page-link" @click="prevPage">Anterior</a>
          </li>
          <li class="page-item" :class="{disabled: currentPage >= totalPages}">
            <a class="page-link" @click="nextPage">Siguiente</a>
          </li>
        </ul>
      </nav>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        quotes: [],
        currentPage: 1,
        pageSize: 10,
        total: 0
      };
    },
    async mounted() {
      await this.fetchQuotes();
    },
    computed: {
      totalPages() {
        return Math.ceil(this.total / this.pageSize);
      }
    },
    methods: {
      async fetchQuotes() {
        const response = await fetch(`/api/quotes?page=${this.currentPage}&limit=${this.pageSize}`);
        const data = await response.json();
        this.quotes = data.slice(0, this.pageSize);
        this.total = data.length;
      },
      prevPage() {
        if (this.currentPage > 1) {
          this.currentPage--;
          this.fetchQuotes();
        }
      },
      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.currentPage++;
          this.fetchQuotes();
        }
      }
    }
  };
  </script>