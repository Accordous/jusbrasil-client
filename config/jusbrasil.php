<?php

return [
    'host' => env('JUSBRASIL_HOST', 'https://dossier-api.jusbrasil.com.br'),
    'api' => env('JUSBRASIL_API', '/v5'),
    'token' => env('JUSBRASIL_TOKEN'),
    'webhook' => env('JUSBRASIL_WEBHOOK', ''),
    'cache_control' => env('JUSBRASIL_CACHE_CONTROL', '86400'),
];
