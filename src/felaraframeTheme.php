<?php
namespace feiron\fe_theme;

use feiron\fe_theme\lib\contracts\feTheme;

class felaraframeTheme implements feTheme {

    private $myDomainName;
    private $mySettings;
    private $themeResources=[];

    public function __construct()
    {
        $this->myDomainName= 'fe_theme';
        if (env('APP_DEBUG', false)) {
            $this->themeResources=[
                'headerstyles'=>[
                    'bootstrap5beta/css/bootstrap.css',
                    'fontawesome5.15.2/css/all.css',
                    'css/frame.css'
                ],
                'headerscripts'=>[
                    'bootstrap5beta/js/bootstrap.bundle.js'
                ]
            ];
        }else{
            $this->themeResources=[
                'headerstyles'=>[
                    'bootstrap5beta/css/bootstrap.min.css',
                    'fontawesome5.15.2/css/all.min.css',
                    'css/frame.css'
                ],
                'headerscripts'=>[
                    'bootstrap5beta/js/bootstrap.bundle.min.js'
                ]
            ];
        }
        $this->mySettings=[
            "Layouts"=>[
                'Side Bar'=>[
                    'Structures' => [
                        'type' => 'radio',
                        'options' => ['Normal', 'Condensed'],
                        'default' => 'Normal',
                        'name'=>'sb_structure'
                    ],
                    'Style' => [
                        'type' => 'radio',
                        'options' => ['Fixed', 'Fluid'],
                        'default' => 'Fixed',
                        'name' => 'sb_style'
                    ],
                    'Show On' => [
                        'type' => 'radio',
                        'options' => ['Hover','Always'],
                        'default' => 'Always',
                        'name' => 'sb_showon'
                    ],
                    'SubMenu Shown On' => [
                        'type' => 'radio',
                        'options' => ['Click', 'Hover'],
                        'default' => 'Click',
                        'name' => 'sb_subshowon'
                    ],
                    'Initial Behavior' => [
                        'type' => 'radio',
                        'options' => ['Normal', 'Collapsed'],
                        'default' => 'Normal',
                        'name' => 'sb_initbh'
                    ],
                    'Top Display' => [
                        'type' => 'radio',
                        'options' => ['Profile Image', 'Mini Profile Image', 'Icon','None'],
                        'default' => 'Icon',
                        'name' => 'sb_topdisplay'
                    ]
                ],
                'Top Bar' => [
                    'Location' => [
                        'type' => 'radio',
                        'options' => ['Fixed', 'Fluid'],
                        'default' => 'Fixed',
                        'name' => 'tb_location'
                    ]
                ],
                'Page'=>[
                    
                    'Color' => [
                        'type' => 'select',
                        'options' => ['Primary', 'Dark', 'red', 'green', 'orange', 'purple', 'blue'],
                        'default' => 'Dark',
                        'name' => 'page_color'
                    ],
                    'Background Color' => [
                        'type' => 'select',
                        'options' => ['Clean', 'Lighter', 'Light-default', 'Light-blue', 'Light-purple', 'Light-dark'],
                        'default' => 'Light-blue',
                        'name' => 'page_bgcolor'
                    ],
                    'Display' => [
                        'type' => 'radio',
                        'options' => ['Full Width', 'Boxed'],
                        'default' => 'Full Width',
                        'name' => 'page_display'
                    ],
                    'Template Style' => [
                        'type' => 'radio',
                        'options' => ['Dark 1', 'Dark 2', 'Light 1', 'Light 2'],
                        'default' => 'Dark 1',
                        'name' => 'page_template'
                    ]
                ]
            ]
        ];
    }

    public function getThemeResources():array{
        return $this->themeResources;
    }

    public function name():string{
        return $this->myDomainName;
    }

    public function title():string{
        return 'Iron Frame';
    }

    public function themeSettings():array{
        return $this->mySettings;
    }

}