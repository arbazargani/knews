<?php
/**
 * Created by PhpStorm.
 * User: Nassaji
 * Date: 12/22/2018
 * Time: 12:35 PM
 */

namespace App\Libraries;


use App\Ads;

class AdsInject
{
    public function fetch()
    {
        return Ads::where('status', 'active')->where('location', 'left')->where('lang',\App::getLocale())->orderBy('created_at', 'Desc')->get();
    }
}