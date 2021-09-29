<?php

namespace Accordous\JusBrasilClient\Tests\Unit;

use Accordous\JusBrasilClient\Services\JusBrasilService;
use Accordous\JusBrasilClient\Tests\TestCase;

class ReportTest extends TestCase
{
    /**
     * @test
     */
    public function canCreateDossier()
    {
        $service = new JusBrasilService();

        $filter = explode(',', env('JUSBRASIL_FILTER'));

        $response = $service->dossier()->lawsuits($filter);

        $data = $response->json();

        $this->assertArrayHasKey('dossier_id', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertEquals('OK', $data['status']);
    }

    /**
     * @test
     */
    public function canDetailDossier()
    {
        $service = new JusBrasilService();

        $response = $service->dossier()->detail(env('JUSBRASIL_DOSSIER_ID'));

        $data = $response->json();

        $this->assertArrayHasKey('_id', $data);
    }

    /**
     * @test
     */
    public function canListFilesDossier()
    {
        $service = new JusBrasilService();

        $response = $service->dossier()->files(env('JUSBRASIL_DOSSIER_ID'));

        $data = $response->json();

        $this->assertArrayHasKey('files', $data);
    }
}
