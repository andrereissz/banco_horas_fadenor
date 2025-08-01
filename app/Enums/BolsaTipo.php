<?php

namespace App\Enums;

enum BolsaTipo: int
{
    case Fadenor = 0;
    case Fapemig = 1;
    case Trilhas = 2;

    public function label(): string
    {
        return match ($this) {
            self::Fadenor => 'Fadenor',
            self::Fapemig => 'Fapemig',
            self::Trilhas => 'Trilhas',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Fadenor => 'bg-blue-500',
            self::Fapemig => 'bg-green-500',
            self::Trilhas => 'bg-yellow-500',
        };
    }
}
