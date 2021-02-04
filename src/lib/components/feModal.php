<?php

namespace feiron\fe_theme\lib\components;

use Illuminate\View\Component;

class feModal extends Component
{
    public $direction;
    public $size;
    public $hasForm;
    public $action;
    public $name; 
    public $formId;
    public $method;
    public $headerBg;
    public $footerBg;

    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('fe_theme::components.Modal');
    }
}
