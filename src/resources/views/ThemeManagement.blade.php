<x-fe_theme::fe-portlet id="FeThemeManagement" dataTarget="{{route('updateThemeSetting')}}" class="bg-white Profile-container h-100 mb-0" header-bg="primary">
    <x-slot name="header">
        <h3><strong>Theme</strong> Selected</h1>
    </x-slot>
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="alert alert-info p-1">
                Select a Site Theme from the list below. 
            </div>
            <select name="fe_themeSelector" id="fe_themeSelector" class="w-100">
                @foreach (app()->feThemeManager->GetThemes() as $theme)
                    <option {{(app()->feThemeManager->GetCurrentTheme()->name()==$theme->name())?'SELECTED':''}} value="{{$theme->name()}}">{{$theme->title()}}</option>
                @endforeach
            </select>
            <div id="feThemeInfo">
                
            </div>
        </div>
        <div class="col-sm-12 col-md-8">
            <div id="feThemeDetails">
                {!! app()->feThemeManager->GetCurrentTheme()->description() !!}
            </div>
        </div>
    </div>
</x-fe_theme::fe-portlet>

<x-fe_theme::fe-portlet id="FeThemeSettings" class="my-2" dataTarget="{{route('updateThemeSetting')}}">
    <x-slot name="header">
        <h2>Theme <strong>Settings</strong></h2>
    </x-slot>
    {!!app()->feThemeManager->RenderThemeSettings()!!}
    <div class="clearfix">
    </div>
</x-fe_theme::fe-portlet>

<div>
    <button class="btn btn-primary pull-right m-b-10 btn_themesave">Update Theme Settings</button>
    <div class="clearfix">
    </div>
</div>

<div id="admin-resources">
    @foreach ((app()->feThemeManager->GetCurrentTheme()->getAdminResources()??[]) as $resouce)
        <script src="{{asset("/feiron/".app()->feThemeManager->GetCurrentTheme()->name().'/'.$resouce)}}"></script>
    @endforeach
</div>