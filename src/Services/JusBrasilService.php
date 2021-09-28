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
     * @throws \Exception
     */
    public function __construct()
    {
        $this->http = Http::withoutVerifying()
            ->baseUrl(Config::get('jusbrasil.host') . Config::get('jusbrasil.api'))
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
