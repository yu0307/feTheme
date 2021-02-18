<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'feiron\fe_theme\http\controllers', 'middleware' => ['web', 'auth']], function () {
    Route::get('notifications/{MID?}','fe_NotificationUI@show')->name('LF_Notifications');
    Route::get('profile/{uid?}','fe_ProfileUI@show')->name('Profile');
    Route::get('controlpanel','fe_controlpanelUI@show');
});
?>