<?php

namespace feiron\fe_theme\lib\components;

use Illuminate\View\Component;

class feUploader extends Component
{
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
        return view('fe_theme::components.form.FileUpload');
    }
}
