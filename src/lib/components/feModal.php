<?php

namespace feiron\fe_theme\lib\components;

use Illuminate\View\Component;

class feModal extends Component
{
    public $dialogOptions;
    public $headerBg;
    public $footerBg;

    public function __construct($dialogOptions='modal-dialog-centered modal-dialog-scrollable modal-lg',$headerBg='bg-primary',$footerBg='bg-dark')
    {
        $this->dialogOptions=$dialogOptions;
        $this->headerBg=$headerBg;
        $this->footerBg=$footerBg;
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
