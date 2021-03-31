<?php
namespace feiron\fe_theme;

use feiron\fe_theme\lib\contracts\feTheme;

class felaraframeTheme implements feTheme {

    private $myDomainName;
    private $mySettings;
    private $themeResources=[];
    private $adminResources=[];

    public function __construct()
    {
        $this->myDomainName= 'fe_theme';
        if (env('APP_DEBUG', false)) {
            $this->themeResources=[
                'headerstyles'=>[
                    'bootstrap5beta/css/bootstrap.css',
                    'fontawesome5.15.2/css/all.css',
                    'animate/animate.min.css',
                    'OverlayScrollbars-1.13.1/css/OverlayScrollbars.css',
                    'css/util.css',
                    'css/frame.css'
                ],
                'headerscripts'=>[
                    'bootstrap5beta/js/bootstrap.bundle.js',
                    'OverlayScrollbars-1.13.1/js/OverlayScrollbars.js',
                    'js/app.js',
                    'js/util.js'
                ]
            ];
        }else{
            $this->themeResources=[
                'headerstyles'=>[
                    'bootstrap5beta/css/bootstrap.min.css',
                    'fontawesome5.15.2/css/all.min.css',
                    'animate/animate.min.css',
                    'OverlayScrollbars-1.13.1/css/OverlayScrollbars.min.css',
                    'css/util.min.css',
                    'css/frame.min.css'
                ],
                'headerscripts'=>[
                    'bootstrap5beta/js/bootstrap.bundle.min.js',
                    'OverlayScrollbars-1.13.1/js/OverlayScrollbars.min.js',
                    'js/app.min.js',
                    'js/util.min.js',
                ]
            ];
        }
        $this->adminResources=[
            'js/modules/admin.js'
        ];
        $this->mySettings=[
            "Layouts"=>[
                'Side Bar'=>[
                    'Structures' => [
                        'type' => 'radio',
                        'options' => ['Normal', 'Condensed'],
                        'default' => 'Normal',
                        'name'=>'sb_structure'
                    ],
                    'Show On' => [
                        'type' => 'radio',
                        'options' => ['Hover','Always'],
                        'default' => 'Always',
                        'name' => 'sb_showon'
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
                        'default' => 'Mini Profile Image',
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
                    'Page Color' => [
                        'type' => 'select',
                        'options' => ['Dark', 'Blue', 'Red', 'Green','Orange','Purple','Navy Blue'],
                        'default' => 'Dark',
                        'name' => 'page_color'
                    ],
                    'Background Color' => [
                        'type' => 'select',
                        'options' => ['Color1', 'Color2', 'Color3', 'Color4', 'Color5', 'Color6'],
                        'default' => 'Color4',
                        'name' => 'page_bgcolor'
                    ],
                    'Template Style' => [
                        'type' => 'radio',
                        'options' => ['Style 1', 'Style 2', 'Style 3', 'Style 4'],
                        'default' => 'Style 1',
                        'name' => 'page_template'
                    ]
                ]
            ]
        ];
    }

    public function getThemeResources():array{
        return $this->themeResources;
    }

    public function getAdminResources():array{
        return $this->adminResources;
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

    public function description():string{
        return '
            <h5>This is the default theme provided by the framework. </h5>
            You are free to make changes on the layout with the options provided below. 
            For more information on how to use this theme please refer to: <br/>
            Github <a href="https://github.com/yu0307/LaraFrame" target="_blank">FeLaraFrame</a>
        ';
    }

}