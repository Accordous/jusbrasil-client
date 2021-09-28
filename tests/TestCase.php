<?php

namespace Accordous\JusBrasilClient\Tests;

use Accordous\JusBrasilClient\Providers\JusBrasilClientServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * add the package provider
     *
     * @param  Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            JusBrasilClientServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app->useEnvironmentPath(__DIR__.'/..');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);

        $app['config']->set('jusbrasil.host', 'https://dossier-api.jusbrasil.com.br');
        $app['config']->set('jusbrasil.api', '/v5');
        $app['config']->set('jusbrasil.token', env('JUSBRASIL_TOKEN'));
    }
}
