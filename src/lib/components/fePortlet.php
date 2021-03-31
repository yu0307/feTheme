<?php

namespace feiron\fe_theme\lib\components;

use Illuminate\View\Component;

class fePortlet extends Component
{
    public $headerBg;
    public $headerControls;
    public $footerBg;

    public function __construct($headerBg='dark',$headerControls=false,$footerBg='dark')
    {
        $this->headerBg=$headerBg;
        $this->headerControls=$headerControls;
        $this->footerBg=$footerBg;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('fe_theme::components.layout.Portlet');
    }
}
