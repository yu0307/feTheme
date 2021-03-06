<?php

namespace feiron\fe_theme\lib\components;

use Illuminate\View\Component;

class feDataTable extends Component
{
    public $headerBg;
    public $headerList;
    public $filterLocation;
    public $tableData;
    public $jsSettins;
    public $enableHeaderSearch;

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
        return view('fe_theme::components.DataTables');
    }
}
