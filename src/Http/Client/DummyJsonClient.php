namespace Kenpru1\Quotesconsumer\Http\Client;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class DummyJsonClient
{
    protected $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getQuotes(): array
    {
        $response = Http::get("{$this->baseUrl}/quotes");
        return $response->json()['quotes'] ?? [];
    }

    public function getQuoteById(int $id): ?array
    {
        $response = Http::get("{$this->baseUrl}/quotes/{$id}");
        return $response->successful() ? $response->json() : null;
    }
}