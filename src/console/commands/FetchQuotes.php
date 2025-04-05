namespace Kenpru1\Quotesconsumer\Console\Commands;

use Illuminate\Console\Command;
use Kenpru1\Quotesconsumer\Facades\Quotes;

class FetchQuotes extends Command
{
    protected $signature = 'quotes:fetch';
    protected $description = 'Fetch and cache quotes from API';

    public function handle()
    {
        try {
            $quotes = Quotes::getAllQuotes();
            $this->info('Quotes cached successfully: ' . count($quotes) . ' quotes');
        } catch (\Exception $e) {
            $this->error('Error fetching quotes: ' . $e->getMessage());
        }
    }
}