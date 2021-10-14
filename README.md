# JusBrasil

Esse pacote auxilia no consumo da API do JusBrasil utilizando Laravel.


## Instalação
```
composer require accordous/jusbrasil-client
```

## Requisitos
- Composer 2
- PHP 7.4+
- Laravel 7+

## Recursos
- Solicitar um dossier
```php
use Accordous\JusBrasilClient\Services\JusBrasilService;

$service = new JusBrasilService();

$filter = ['termo1', 'termo2', 'termo3'];

$response = $service->dossier()->lawsuits($filter);

$result = $response->json();
```

- Detalhar solicitação de um dossier
```php
use Accordous\JusBrasilClient\Services\JusBrasilService;

$service = new JusBrasilService();

$dossier_id = '0123456789';

$response = $service->dossier()->detail($dossier_id);

$result = $response->json();
```

- Verificar processos capturados em dossier
```php
use Accordous\JusBrasilClient\Services\JusBrasilService;

$service = new JusBrasilService();

$dossier_id = '0123456789';

$response = $service->dossier()->files($dossier_id);

$files = $response->json();
```

- Acessar arquivo de um processo
```php
use Accordous\JusBrasilClient\Services\JusBrasilService;

$service = new JusBrasilService();

$file_url = 'https://arquivodoprocesso.jusbrasil.com.br';

$response = $service->dossier()->download($file_url);

$result = $response->json();
```

## Testes
Configurando um arquivo `.env` os testes podem ser executados via docker utilizando o Makefile

```
make phpunit 

make phpunit --filter 'parametro1|parametro2'
```