<?php

namespace feiron\fe_theme\lib\components;

use Illuminate\View\Component;

class feAccordion extends Component
{
    public $style;
    public $id;
    public $items;

    public function __construct($items=[],$id=null,$style='default')
    {
        $this->items=$items;
        $this->id=$id;
        $this->style=$style;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('fe_theme::components.layout.Accordion');
    }
}
