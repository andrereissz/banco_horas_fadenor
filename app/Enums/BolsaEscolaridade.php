<?php

namespace App\Enums;

enum BolsaEscolaridade: int
{
    case Analfabeto = 1;
    case QuintoAnoIncompleto = 2;
    case QuintoAnoCompleto = 3;
    case FundamentalIncompleto = 4;
    case FundamentalCompleto = 5;
    case MedioIncompleto = 6;
    case MedioCompleto = 7;
    case SuperiorIncompleto = 8;
    case SuperiorCompleto = 9;
    case PosGraduacao = 10;
    case Mestrado = 11;
    case Doutorado = 12;

    public function label(): string
    {
        return match ($this) {
            self::Analfabeto => 'Analfabeto',
            self::QuintoAnoIncompleto => '5º Ano Incompleto',
            self::QuintoAnoCompleto => '5º Ano Completo',
            self::FundamentalIncompleto => 'Fundamental Incompleto',
            self::FundamentalCompleto => 'Fundamental Completo',
            self::MedioIncompleto => 'Médio Incompleto',
            self::MedioCompleto => 'Médio Completo',
            self::SuperiorIncompleto => 'Superior Incompleto',
            self::SuperiorCompleto => 'Superior Completo',
            self::PosGraduacao => 'Pós Graduação',
            self::Mestrado => 'Mestrado',
            self::Doutorado => 'Doutorado',
        };
    }
}
