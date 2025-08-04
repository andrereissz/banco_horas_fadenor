<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\TestCase;

class AuthBolsistaServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
