namespace kenpru1\quotesconsumer\Tests\Unit;

use Tests\TestCase;
use kenpru1\quotesconsumer\Facades\Quotes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class QuotesServiceTest extends TestCase
{
    public function test_get_all_quotes()
    {
        Http::fake([
            'https://dummyjson.com/quotes' => Http::response([
                'quotes' => [['id' => 1, 'text' => 'Test quote']]
            ])
        ]);

        $quotes = Quotes::getAllQuotes();
        $this->assertCount(1, $quotes);
        $this->assertEquals('Test quote', $quotes[0]['text']);
    }

    public function test_binary_search()
    {
        $testData = [
            ['id' => 1, 'text' => 'A'],
            ['id' => 3, 'text' => 'B'],
            ['id' => 5, 'text' => 'C']
        ];

        Cache::shouldReceive('get')
             ->once()
             ->with('quotes_data')
             ->andReturn($testData);

        $quote = Quotes::getQuoteById(3);
        $this->assertEquals('B', $quote['text']);
    }
}