namespace Kenpru1\Quotesconsumer\Services;

use Illuminate\Support\Facades\Cache;
use Kenpru1\Quotesconsumer\Exceptions\RateLimitExceededException;

class RateLimiter
{
    protected $maxRequests;
    protected $windowDuration;

    public function __construct()
    {
        $this->maxRequests = config('quotes.max_requests');
        $this->windowDuration = config('quotes.window_duration');
    }

    public function checkLimit(): void
    {
        $key = 'quotes_api_requests';
        $count = Cache::get($key, 0);

        if ($count >= $this->maxRequests) {
            $remainingTime = $this->windowDuration - (time() - Cache::get("{$key}_start"));
            sleep(max(0, $remainingTime));
            $count = 0;
            Cache::forget($key);
        }

        Cache::put($key, $count + 1, $this->windowDuration);
        if ($count === 0) {
            Cache::put("{$key}_start", time(), $this->windowDuration);
        }
    }
}