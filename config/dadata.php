<?php

return [
    'timeout_in_seconds' => 3,
    'api_url' => env('DADATA_API_URL', 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address'),
    'api_key' => env('DADATA_API_KEY', 'api_key'),
    'secret_key' => env('DADATA_SECRET_KEY', 'secret_key'),
];