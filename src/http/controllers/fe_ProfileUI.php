<?php

namespace feiron\fe_theme\http\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class fe_ProfileUI extends Controller
{
    public function show(Request $request, $uid = null)
    {
        $userProvider = config('auth.providers.' . config('auth.guards.web.provider') . '.model');
        return view('fe_theme::profile', ['User' => (empty($uid) ? auth()->user() : $userProvider::find($uid)), 'Editable' => empty($uid)]);
    }
}
