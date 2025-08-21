<?php

namespace App\Enums;

enum BolsaStatus: int
{
    case AguardandoEnvio = 0;
    case AguardandoResposta = 1;
    case Respondido = 2;
    case Cadastrado = 3;
    case Desligado = 4;
    case Erro = 5;

    public function label(): string
    {
        return match ($this) {
            self::AguardandoEnvio => 'Aguardando Envio',
            self::AguardandoResposta => 'Aguardando Resposta',
            self::Respondido => 'Respondido',
            self::Cadastrado => 'Cadastrado',
            self::Desligado => 'Desligado',
            self::Erro => 'Erro',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::AguardandoEnvio => 'bg-gray-500',
            self::AguardandoResposta => 'bg-yellow-500',
            self::Respondido => 'bg-blue-500',
            self::Cadastrado => 'bg-green-500',
            self::Desligado => 'bg-red-500',
            self::Erro => 'bg-gray-700',
        };
    }
}
