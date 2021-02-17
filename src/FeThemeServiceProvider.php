<?php

namespace feiron\fe_theme;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use feiron\fe_theme\lib\feThemeManager;

class FeThemeServiceProvider extends ServiceProvider {

    public function boot(){

        $PackageName='fe_theme';
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
                                array_merge(View::shared('siteInfo')??[],[
                                    'themeSettings'=> (app()->feThemeManager->GetThemeSettings() ?? []),
                                    'theme'=>(((app()->feThemeManager->GetCurrentTheme())->name())?? 'felaraframe')
                                ])
                    );
        app()->frameOutlet->bindOutlet('Fe_FrameOutlet', new \feiron\felaraframe\lib\outlet\feOutlet([
            'view' => 'felaraframe::ThemeManagement',
            'myName' => 'Theme Management',
            'resource' => [
                asset('/feiron/felaraframe/js/sidebar_hover.js'),
                asset('/feiron/felaraframe/js/ThemeManagement.js')
            ]
        ]));
    }

    public function register(){        
        $this->app->singleton('feThemeManager', function ($app) {
            return new feThemeManager();
        });
    }

    private function registerBladeComponents(){
        Blade::directive('renderMenu', function ($expression) {
            return "<?php echo app()->feThemeManager->renderMenu($expression); ?>";
        });
        Blade::componentNamespace('feiron\\fe_theme\\lib\\components', 'fe_theme');
    }
}

?>