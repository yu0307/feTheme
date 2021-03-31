<?php

namespace feiron\fe_theme\lib\contracts;

interface feTheme
{

    public function name():string;

    public function title():string;

    public function description():string;

    public function themeSettings():array;

    //Resources to be loaded on every page
    public function getThemeResources():array;

    //Resources to be loaded on control panel page
    public function getAdminResources():array;

}
