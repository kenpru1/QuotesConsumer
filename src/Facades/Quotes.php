namespace Kenpru1\Quotesconsumer\Facades;

use Illuminate\Support\Facades\Facade;

class Quotes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Kenpru1\Quotesconsumer\Contracts\QuotesServiceInterface';
    }
}