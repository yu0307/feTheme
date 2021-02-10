<?php

namespace feiron\fe_theme\http\controllers;

use Illuminate\Http\Request;
use feiron\felaraframe\http\controllers\fe_NotificationController as baseController;

class fe_NotificationUI extends baseController
{
    public function show(Request $request, $MID=null)
    {
        return view('fe_theme::notification')->with(['MID'=>$MID]);
    }
}
