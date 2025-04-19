<?php

require 'vendor/autoload.php';

use OpenApi\Generator;

// Escaneie o diretório correto para encontrar as anotações
file_put_contents(
    __DIR__ . '/public/openapi.json', 
    Generator::scan([__DIR__ . '/app/Http/Controllers/Api/V1'])->toJson()
);