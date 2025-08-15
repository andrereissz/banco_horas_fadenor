<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;
use Illuminate\View\View;

class InputTelefone extends Component
{
    public string $name;
    public ?string $id;
    public ?string $value;
    public bool $required;
    public string $label;
    public string $class;
    public string $placeholder;

    public function __construct(
        string $name = 'telefone',
        ?string $id = null,
        ?string $value = null,
        bool $required = false,
        string $label = 'Telefone',
        string $class = 'input input-bordered w-full',
    ) {
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->required = $required;
        $this->label = $label;
        $this->class = $class;
    }

    public function render(): View|string
    {
        return view('components.inputs.input-telefone');
    }
}
