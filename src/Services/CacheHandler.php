namespace kenpru1\quotesconsumer\Services;

use Illuminate\Support\Facades\Cache;

class CacheHandler
{
    protected $cacheKey = 'quotes_data';
    protected $cacheTtl;

    public function __construct()
    {
        $this->cacheTtl = config('quotes.cache_ttl');
    }

    public function getQuotes(): array
    {
        return Cache::get($this->cacheKey, []);
    }

    public function storeQuotes(array $quotes): void
    {
        usort($quotes, function($a, $b) {
            return $a['id'] <=> $b['id'];
        });
        
        Cache::put($this->cacheKey, $quotes, $this->cacheTtl);
    }

    public function findQuoteById(int $id): ?array
    {
        $quotes = $this->getQuotes();
        $low = 0;
        $high = count($quotes) - 1;

        while ($low <= $high) {
            $mid = (int)(($low + $high) / 2);
            if ($quotes[$mid]['id'] === $id) {
                return $quotes[$mid];
            }
            if ($quotes[$mid]['id'] < $id) {
                $low = $mid + 1;
            } else {
                $high = $mid - 1;
            }
        }
        return null;
    }

    public function addQuote(array $quote): void
    {
        $quotes = $this->getQuotes();
        
        // Buscar posición de inserción con búsqueda binaria
        $low = 0;
        $high = count($quotes) - 1;
        $insertAt = 0;

        while ($low <= $high) {
            $mid = (int)(($low + $high) / 2);
            if ($quotes[$mid]['id'] < $quote['id']) {
                $low = $mid + 1;
                $insertAt = $mid + 1;
            } else {
                $high = $mid - 1;
                $insertAt = $mid;
            }
        }

        array_splice($quotes, $insertAt, 0, [$quote]);
        $this->storeQuotes($quotes);
    }

}