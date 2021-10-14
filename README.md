# JusBrasil

Esse pacote auxilia no consumo da API do JusBrasil utilizando Laravel.

## Instalação
```shell
composer require accordous/jusbrasil-client
```

## Configuração

- Publique o arquivo de configuração caso tenha interesse em alterar algum dos valores pré-definidos
```shell
php artisan vendor:publish --tag=JusBrasil
```

- Altere as configurações no arquivo `.env` do seu projeto Laravel
```.dotenv
JUSBRASIL_HOST='https://dossier-api.jusbrasil.com.br'
JUSBRASIL_API='/v5'
JUSBRASIL_WEBHOOK=''

# use o valor o (zero) para reduzir a quantidade de processo 'not delivered'
JUSBRASIL_CACHE_CONTROL=86400

# OBRIGATÓRIO
JUSBRASIL_TOKEN=
```

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

```shell
make phpunit 

make phpunit --filter 'parametro1|parametro2'
```