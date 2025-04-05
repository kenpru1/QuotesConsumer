namespace Kenpru1\Quotesconsumer\Exceptions;

use RuntimeException;

class RateLimitExceededException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Se ha excedido el límite de solicitudes a la API');
    }
}