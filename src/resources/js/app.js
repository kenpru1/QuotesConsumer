import { createApp } from 'vue';
import QuoteList from './components/QuoteList.vue';
import RandomQuote from './components/RandomQuote.vue';
import QuoteSearch from './components/QuoteSearch.vue';

createApp({
  components: {
    QuoteList,
    RandomQuote,
    QuoteSearch
  },
  template: `
    <div class="container mt-5">
      <h1>Citas API</h1>
      <div class="row">
        <div class="col-md-8">
          <QuoteList />
        </div>
        <div class="col-md-4">
          <RandomQuote />
          <QuoteSearch />
        </div>
      </div>
    </div>
  `
}).mount('#app');