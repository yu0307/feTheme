<?php

namespace feiron\feTheme;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use feiron\felaraframe\lib\FeFrame;

class FeThemeServiceProvider extends ServiceProvider {

    public function boot(){

        $PackageName='feTheme';
        //locading package route files
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');        

        //location package view files
        $this->loadViewsFrom(__DIR__ . '/resources/views', $PackageName);
        //loading migration scripts
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->registerBladeComponents();

        $this->publishes([
            __DIR__ . '/config' => config_path($PackageName),
        ], ($PackageName . '_config'));
        //set the publishing target path for asset files. Run only during update and installation of the package. see composer.json of the package.
        $this->publishes([
            __DIR__ . '/assets' => public_path('feiron/' . $PackageName),
        ], ($PackageName . '_public'));

        View::share('siteInfo',
                                array_merge(View::getShared('siteInfo'),[
                                    'themeSettings'=> (app()->FeFrame->GetThemeSettings() ?? []),
                                    'theme'=>(((app()->FeFrame->GetCurrentTheme())->name())?? 'felaraframe')
                                ])
                    );

        app()->frameOutlet->bindOutlet('Fe_FrameOutlet', new \feiron\felaraframe\lib\outlet\feOutlet([
            'view' => 'felaraframe::ThemeManagement',
            'myName' => 'Theme Management',
            'reousrce' => [
                asset('/feiron/felaraframe/js/sidebar_hover.js'),
                asset('/feiron/felaraframe/js/ThemeManagement.js')
            ]
        ]));
    }

    public function register(){        

    }

    private function registerBladeComponents(){
        //read from dir and build a cache and load from cache.
        // Blade::component('fe-sidebar-menu', \feiron\felaraframe\lib\components\feSidebarMenu::class);
        // Blade::component('fe-notes', \feiron\felaraframe\lib\components\feNotes::class);
        // Blade::component('fe-file-upload', \feiron\felaraframe\lib\components\feFileUpload::class);
        // Blade::component('fe-modal', \feiron\felaraframe\lib\components\feModal::class);
        // Blade::component('fe-portlet', \feiron\felaraframe\lib\components\fePortlet::class);
        // Blade::component('fe-date-picker', \feiron\felaraframe\lib\components\feDatePicker::class);
        // Blade::component('fe-data-table', \feiron\felaraframe\lib\components\feDataTable::class);
    }
}

?>