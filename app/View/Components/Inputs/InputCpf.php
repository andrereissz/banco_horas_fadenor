<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;
use Illuminate\View\View;

class InputCpf extends Component
{
    public string $name;
    public ?string $id;
    public ?string $value;
    public bool $required;
    public string $label;
    public string $class;
    public string $placeholder;

    public function __construct(
        string $name = 'cpf',
        ?string $id = null,
        ?string $value = null,
        bool $required = false,
        string $label = 'CPF',
        string $class = 'input input-bordered w-full',
        string $placeholder = '000.000.000-00',
    ) {
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->required = $required;
        $this->label = $label;
        $this->class = $class;
        $this->placeholder = $placeholder;
    }

    public function render(): View|string
    {
        return view('components.inputs.input-cpf');
    }
}
