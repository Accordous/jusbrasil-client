<?php

namespace Accordous\JusBrasilClient\Services;

use Accordous\JusBrasilClient\Services\Endpoints\DossierEndpoint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class JusBrasilService
{
    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    private $http;

    /**
     * @var DossierEndpoint
     */
    private $dossier;

    /**
     * JusBrasilService constructor.
     * @param int|null $maxAge
     */
    public function __construct(?int $maxAge = null)
    {
        $maxAge = $maxAge ?? Config::get('jusbrasil.cache_control');

        $this->http = Http::withoutVerifying()
            ->baseUrl(Config::get('jusbrasil.host') . Config::get('jusbrasil.api'))
            ->withHeaders([
                'Cache-Control' => 'max-age='.$maxAge
            ])
            ->withToken(Config::get('jusbrasil.token'), '');

        $this->dossier =  new DossierEndpoint($this->http);
    }

    /**
     * @return DossierEndpoint
     */
    public function dossier(): DossierEndpoint
    {
        return $this->dossier;
    }
}
