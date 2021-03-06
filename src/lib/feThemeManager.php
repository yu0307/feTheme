<?php

namespace feiron\fe_theme\lib;
use feiron\fe_theme\lib\contracts\feTheme;
use feiron\fe_theme\felaraframeTheme;
use feiron\felaraframe\models\LF_MetaInfo;
class feThemeManager{
    private $theme; //feTheme
    private $themeList; //array of feTheme
    private $themeSetting;
    public function __construct(){
        if (\Schema::hasTable('lf_site_metainfo')) {
            $theme = LF_MetaInfo::where('meta_name', 'theme')->first()->meta_value??(config('felaraframe.appconfig.theme')??felaraframeTheme::class);
            $this->themeSetting = LF_MetaInfo::where('meta_name', 'themeSetting')->first()->meta_value ?? [];
        }else{
            $theme =felaraframeTheme::class;
            $this->themeSetting=[];
        }
        $theme = new $theme();
        $this->theme = ($theme instanceof feTheme)? $theme : (new felaraframeTheme());
        $this->themeList[$this->theme->name()]=$this->theme;
        if(false===array_key_exists('felaraframe', $this->themeList)){ // make sure default theme is always present for users
            $this->AppendTheme(new felaraframeTheme());
        }
        foreach($this->theme->getThemeResources() as $location=>$resources){
            foreach($resources as $resource){
                app()->FeFrame->enqueueResource(asset("/feiron/".$this->theme->name().'/'.$resource),$location);
            }
        }
    }

    public function AppendTheme(feTheme $theme){
        $this->themeList[$theme->name()]= $theme;
    }

    public function ThemeSetting($name){
        return $this->themeSetting[$name];
    }

    public function LoadTheme($themeName){
        $this->theme= $this->themeList[$themeName]?? $this->themeList['felaraframe'];
    }

    public function RemoveTheme($themeName){
        unset($this->themeList[$themeName]);
    }

    public function GetThemeSettings(){
        return $this->themeSetting;
    }

    public function GetCurrentTheme(){
        return $this->theme;
    }

    public function GetThemes(){
        return $this->themeList;
    }

    public function getThemeByName($name){
        return $this->themeList[$name];
    }

    public function RenderThemeSettings(){
        return $this->RenderSettings($this->theme->themeSettings(), $this->themeSetting);
    }

    private function RenderSettings($settingList,$valueList, $heading = 3):string{//html
        $html='';
        foreach($settingList as $key=>$settings){
            $heading=($heading>5)?5:$heading;
            if((false === array_key_exists('type', $settings))){
                $html.= '<div class="form-row row"><h'.$heading.' class="alert '.($heading>3?'alert-success':'').' p-2 mx-2" ><strong>'.$key. '</strong></h' . $heading . '>'.$this->RenderSettings($settings, $valueList, $heading+1). '</div>';
            }else{
                $html .= '<div class="ThemeSettings col-md-4 col-sm-12">
                            <div class="ThemeSettingHeading">
                                <label class="fw-bolder">'. ($settings['label']??$key).'</label>
                            </div>      
                            ' . app()->FeFrame->BuildFormControl($settings, ($valueList[$settings['name']]??null)).'
                          </div>';
            }
        }
        return $html;
    }

    public function renderMenu($menuItems){ // feiron\felaraframe\lib\feMenuItem
        $output = "";
        foreach($menuItems as $menu){
            $hasSub=count($menu['subMenu']??[])>0;
            $output.='
                <li class="menu-item'.$menu['class'].($hasSub?" menu-parent collapse-container collapsible":"").'" '.($hasSub?'data-bs-toggle="collapse" aria-expanded="false"':"").'>
                    <a href="'.($menu['href']??'#').'" class="d-block ps-3">
                        '.((isset($menu['icon']) && strlen($menu['icon'])>0)?('<i class="align-middle d-inline-block '.$menu['icon'].'"></i>'):"").'
                        <span class="align-middle d-inline-block text-truncate menu-title">'.$menu['title'].'</span>
                        '.($hasSub?'<span class="sub-menu-arrow align-middle d-inline-block float-end"><i class="fas fa-angle-right"></i></span>':"").'
                    </a>
                    '.($hasSub?('
                    <ul class="sub-menu collapse">
                        <li class="d-none parent-title">'.$menu['title'].'</li>
                        '.$this->renderMenu($menu['subMenu']).'
                    </ul>
                    '):"").'
                </li>
            ';
        }
        return $output;
    }
}