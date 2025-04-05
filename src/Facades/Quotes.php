namespace kenpru1\Quotesconsumer\Facades;

use Illuminate\Support\Facades\Facade;

class Quotes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'kenpru1\quotesconsumer\Contracts\QuotesServiceInterface';
    }
}