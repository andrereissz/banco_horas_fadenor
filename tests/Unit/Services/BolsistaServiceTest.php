<?php

namespace Tests\Feature;

use App\Services\AuthBolsistaServiceInterface;
use App\Services\BolsistaServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BolsistaServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected BolsistaServiceInterface $bolsistaService;
    protected AuthBolsistaServiceInterface $authBolsistaService;
    protected function setUp(): void
    {
        parent::setUp();
        $this->bolsistaService = $this->app->make(BolsistaServiceInterface::class);
        $this->authBolsistaService = $this->app->make(AuthBolsistaServiceInterface::class);
    }

    public function test_if_a_bolsista_can_be_found()
    {
        $bolsista = $this->authBolsistaService->register([
            
        ])
        $this->bolsistaService->find('12345678901');
    }
}
