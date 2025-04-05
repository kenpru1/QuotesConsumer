namespace kenpru1\quotesconsumer\Http\Controllers;

use Illuminate\Http\Request;
use Kenpru1\quotesconsumer\Services\QuotesService;
use Kenpru1\quotesconsumer\Facades\Quotes;

class ApiController
{
    protected $service;

    public function __construct(QuotesService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json(Quotes::getAllQuotes());
    }

    public function random()
    {
        return response()->json(Quotes::getRandomQuote());
    }

    public function show($id)
    {
        $quote = Quotes::getQuoteById((int)$id);
        return $quote 
            ? response()->json($quote) 
            : response()->json(['error' => 'Not found'], 404);
    }
}