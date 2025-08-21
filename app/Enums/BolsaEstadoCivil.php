<?php

namespace App\Enums;

enum BolsaEstadoCivil: int
{
    case Solteiro = 1;
    case Casado = 2;
    case Desquitado = 3;
    case Divorciado = 4;
    case Viuvo = 5;
    case UniaoEstavel = 6;
    case Separado = 7;
    case Outros = 8;

    public function label(): string
    {
        return match ($this) {
            self::Solteiro => 'Solteiro(a)',
            self::Casado => 'Casado(a)',
            self::Desquitado => 'Desquitado(a)',
            self::Divorciado => 'Divorciado(a)',
            self::Viuvo => 'Viuvo(a)',
            self::UniaoEstavel => 'União Estavel',
            self::Separado => 'Separado(a)',
            self::Outros => 'Outros',
        };
    }
}
