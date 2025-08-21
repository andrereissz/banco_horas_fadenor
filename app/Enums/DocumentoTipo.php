<?php

namespace App\Enums;

enum DocumentoTipo: int
{
    case termo_bolsa = 0;
    case termo_lgpd = 1;
    case termo_raca = 2;
    case documento_pessoal = 3;
    case comprovante_residencia = 4;
    case declaracao_academica = 5;


    public function label(): string
    {
        return match ($this) {
            self::termo_bolsa => 'Termo de bolsa',
            self::termo_lgpd => 'Termo de LGPD',
            self::termo_raca => 'Termo de Raca/Cor',
            self::documento_pessoal => 'Documento de Identificação Pessoal Com Foto (CIN, CNH, Passaporte, RG)',
            self::comprovante_residencia => 'Comprovante de Residência',
            self::declaracao_academica => 'Declaração acadêmica (Comprovante de Matrícula / Certificação de Grau Acadêmico)',
        };
    }
}
