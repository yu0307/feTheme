<?php

namespace feiron\fe_theme\http\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class fe_controlpanelUI extends Controller
{
    public function show(Request $request){
        return view('fe_theme::controlPanel');
    }
}
