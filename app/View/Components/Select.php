<?php
namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $label;
    public $name;
    public $options;
    public $selected;
    public $required;
    public $placeholder;

    public function __construct($label = '', $name, $options = [], $selected = '', $required = false, $placeholder = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->options = $options;
        $this->selected = $selected;
        $this->required = $required;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.select');
    }
}