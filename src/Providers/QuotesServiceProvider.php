namespace kenpru1\quotesconsumer\Providers;

use Illuminate\Support\ServiceProvider;
use kenpru1\quotesconsumer\Services\QuotesService;
use kenpru1\quotesconsumer\Http\Client\DummyJsonClient;
use kenpru1\quotesconsumer\Services\CacheHandler;
use kenpru1\quotesconsumer\Services\RateLimiter;

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