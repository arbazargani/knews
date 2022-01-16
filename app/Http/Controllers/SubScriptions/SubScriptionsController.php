<?php

namespace App\Http\Controllers\SubScriptions;

use App\SubScription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubScriptionsController extends Controller
{
    public function index()
    {
        $sub_scriptions = SubScription::where('status','active')->get();
        return view(\App::getLocale() . '.subscriptions.list',compact('sub_scriptions'));
    }

    public function order($id)
    {
        dd('درگاه');
    }
}
