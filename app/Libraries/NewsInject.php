<?php
/**
 * Created by PhpStorm.
 * User: Saeed
 * Date: 12/24/2018
 * Time: 3:18 PM
 */

namespace app\Libraries;


use App\News;
use Carbon\Carbon;

class NewsInject
{
    public function fetch_titr2($count = 4)
    {
        $nowdate = Carbon::now()->toDateTimeString();
        return News::where('status', 'active')->where('type', 'titr2')->where('created_at', '<=' , $nowdate )->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take($count)->get();
    }

}