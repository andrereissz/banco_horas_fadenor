<?php

namespace App\Enums;

enum BolsaRacaCor: int
{
    case Indigena = 1;
    case Branca = 2;
    case Preta = 3;
    case Amarela = 4;
    case Parda = 5;
    case NaoInformada = 6;

    public function label(): string
    {
        return match ($this) {
            self::Indigena => 'Indígena',
            self::Branca => 'Branca',
            self::Preta => 'Preta',
            self::Amarela => 'Amarela',
            self::Parda => 'Parda',
            self::NaoInformada => 'Não Informada',
        };
    }
}
