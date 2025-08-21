<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;
use Illuminate\View\View;

class SelectUf extends Component
{
    public string $name;
    public ?string $id;
    public ?string $selected;
    public bool $required;
    public string $placeholder;
    public string $class;

    /** UF => Nome */
    public const STATES = [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraiba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins',
    ];

    public function __construct(
        string $name = 'estado',
        ?string $id = null,
        ?string $selected = '',
        bool $required = false,
        string $placeholder = 'Selecione um Estado',
        string $class = 'select select-bordered w-full',
    ) {
        $this->name = $name;
        $this->id = $id;
        $this->selected = $selected;
        $this->required = $required;
        $this->placeholder = $placeholder;
        $this->class = $class;
    }

    public function states(): array
    {
        return self::STATES;
    }

    public function render(): View|string
    {
        return view('components.inputs.select-uf', [
            'estados' => $this->states(),
        ]);
    }
}
