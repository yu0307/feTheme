<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'feiron\fe_theme\http\controllers', 'middleware' => ['web', 'auth']], function () {
    Route::get('notifications/{MID?}','fe_NotificationUI@show')->name('LF_Notifications');
});
?>