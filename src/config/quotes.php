return [
    'api_url' => env('QUOTES_API_URL', 'https://dummyjson.com'),
    'max_requests' => env('QUOTES_MAX_REQUESTS', 60),
    'window_duration' => env('QUOTES_WINDOW_DURATION', 60),
    'cache_ttl' => env('QUOTES_CACHE_TTL', 3600), // 1 hora
];