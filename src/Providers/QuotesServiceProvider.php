namespace Kenpru1\Quotesconsumer\Providers;

use Illuminate\Support\ServiceProvider;
use Kenpru1\Quotesconsumer\Services\QuotesService;
use Kenpru1\Quotesconsumer\Http\Client\DummyJsonClient;
use Kenpru1\Quotesconsumer\Services\CacheHandler;
use Kenpru1\Quotesconsumer\Services\RateLimiter;

class QuotesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/quotes.php', 'quotes');

        $this->app->singleton('quotes.client', function ($app) {
            return new DummyJsonClient(
                $app['config']->get('quotes.api_url')
            );
        });

        $this->app->singleton(QuotesServiceInterface::class, function ($app) {
            return new QuotesService(
                $app['quotes.client'],
                new CacheHandler(),
                new RateLimiter()
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/quotes.php' => config_path('quotes.php'),
        ], 'config');
        // Registrar rutas API
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');

        // Registrar rutas de la UI
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'quotes');
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        $this->publishes([
             __DIR__.'/../../resources/views' => resource_path('views/vendor/quotes'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../../public' => public_path('vendor/quotes'),
        ], 'public');
    }
}