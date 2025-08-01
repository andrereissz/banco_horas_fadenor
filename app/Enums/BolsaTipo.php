<?php

namespace App\Enums;

enum BolsaTipo: int
{
    case FADENOR = 0;
    case FAPEMIG = 1;
    case Trilhas = 2;

    public function label(): string
    {
        return match ($this) {
            self::FADENOR => 'FADENOR',
            self::FAPEMIG => 'FAPEMIG',
            self::Trilhas => 'Trilhas',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::FADENOR => 'bg-blue-500',
            self::FAPEMIG => 'bg-green-500',
            self::Trilhas => 'bg-yellow-500',
        };
    }
}
