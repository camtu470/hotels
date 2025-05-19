<?php
namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $name;
    public $type;
    public $value;
    public $required;
    public $placeholder;

    public function __construct($label = '', $name, $type = 'text', $value = '', $required = false, $placeholder = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->required = $required;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.input');
    }
}