namespace Kenoru1\Quotesconsumer\Services;

use Kenoru1\Quotesconsumer\Contracts\QuotesServiceInterface;
use Kenoru1\Quotesconsumer\Exceptions\RateLimitExceededException;

class QuotesService implements QuotesServiceInterface
{
    protected $client;
    protected $cache;
    protected $rateLimiter;

    public function __construct(
        $client,
        CacheHandler $cache,
        RateLimiter $rateLimiter
    ) {
        $this->client = $client;
        $this->cache = $cache;
        $this->rateLimiter = $rateLimiter;
    }

    public function getAllQuotes(): array
    {
        $quotes = $this->cache->getQuotes();
        if (empty($quotes)) {
            $this->rateLimiter->checkLimit();
            $quotes = $this->client->getQuotes();
            $this->cache->storeQuotes($quotes);
        }
        return $quotes;
    }

    public function getRandomQuote(): ?array
    {
        $quotes = $this->getAllQuotes();
        return $quotes[array_rand($quotes)] ?? null;
    }

    public function getQuoteById(int $id): ?array
    {
        // Primero verificar caché
        $quote = $this->cache->findQuoteById($id);
        if ($quote) {
            return $quote;
        }

        // Si no está en caché, obtener de la API
        $this->rateLimiter->checkLimit();
        $quote = $this->client->getQuoteById($id);

        if ($quote) {
            $this->cache->addQuote($quote); // Insertar ordenadamente
            return $quote;
        }

        return null;
    }

}