<?php

namespace feiron\fe_theme\lib\contracts;

interface feTheme
{

    public function name():string;

    public function title():string;

    public function description():string;

    public function themeSettings():array;

    public function getThemeResources():array;

}
