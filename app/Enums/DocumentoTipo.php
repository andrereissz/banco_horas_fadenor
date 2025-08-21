<?php

namespace App\Enums;

enum DocumentoTipo: int
{
    case TERMO_BOLSA = 0;
    case TERMO_LGPD = 1;
    case TERMO_RACA = 2;
    case DOCUMENTO_PESSOAL = 3;
    case COMPROVANTE_RESIDENCIA = 4;
    case DECLARACAO_ACADEMICA = 5;


    public function label(): string
    {
        return match ($this) {
            self::TERMO_BOLSA => 'Termo de bolsa',
            self::TERMO_LGPD => 'Termo de LGPD',
            self::TERMO_RACA => 'Termo de Raca/Cor',
            self::DOCUMENTO_PESSOAL => 'Documento de Identificação Pessoal Com Foto (CIN, CNH, Passaporte, RG)',
            self::COMPROVANTE_RESIDENCIA => 'Comprovante de Residência',
            self::DECLARACAO_ACADEMICA => 'Declaração acadêmica (Comprovante de Matrícula / Certificação de Grau Acadêmico)',
        };
    }
}
