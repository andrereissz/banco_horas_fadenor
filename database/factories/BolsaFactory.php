<?php

namespace Database\Factories;

use App\Enums\BolsaStatus;
use App\Enums\BolsaTipo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bolsa>
 */
class BolsaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'projeto_cod' => '111',
            'projeto_nome' => 'projeto teste',
            'projeto_num' => 'APQ-09512',
            'status' => BolsaStatus::AguardandoResposta,
            'tipo' => BolsaTipo::FAPEMIG->value,
            'valor' => '100000',
            'data_inicio' => '2025-07-01',
            'data_fim' => '2026-07-01',
        ];
    }
}
