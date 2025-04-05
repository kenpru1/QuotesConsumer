use Illuminate\Support\Facades\Route;
use kenpru1\quotesconsumer\Http\Controllers\ApiController;

Route::prefix('api/quotes')->group(function() {
    Route::get('/', [ApiController::class, 'index']);
    Route::get('/random', [ApiController::class, 'random']);
    Route::get('/{id}', [ApiController::class, 'show']);
});