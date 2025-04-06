namespace kenpru1\quotesconsumer\Tests\Unit;

use Tests\TestCase;
use kenpru1\quotesconsumer\Services\CacheHandler;

class CacheHandlerTest extends TestCase
{
    public function test_binary_insertion()
    {
        $cache = new CacheHandler();
        
        // Insertar en orden aleatorio
        $quotes = [
            ['id' => 5, 'text' => 'Cinco'],
            ['id' => 2, 'text' => 'Dos'],
            ['id' => 7, 'text' => 'Siete']
        ];
        
        foreach ($quotes as $quote) {
            $cache->addQuote($quote);
        }

        $cachedQuotes = $cache->getQuotes();
        $this->assertEquals([2,5,7], array_column($cachedQuotes, 'id'));
    }
}