<?php

namespace App\Libraries;

use App\ModuleCat;
use App\NewsCat;
use App\SiteSetting;
use App\StaticPage;

class MenuFront
{
	public function fetch()
	{
		return StaticPage::where('status', 'active')->where('cats', '0')->where('lang',\App::getLocale())->where('show_part','menu')->orderBy('created_at', 'Desc')->take(6)->get();
	}

	public function fetch_menu_cat()
	{
		$a = ModuleCat::where('module', 'staticpage')->where('parent_id', '0')->where('lang',\App::getLocale())->orderBy('created_at', 'Desc')->take(6)->get();
		#dd($a);
		return $a;
	}

	public function fetch_footer()
	{
		return StaticPage::where('status', 'active')->where('lang',\App::getLocale())->where('show_part','footer')->orderBy('created_at', 'Desc')->take(6)->get();
	}

	public function fetch_front_newsCat()
	{
		return ModuleCat::where('module', 'news')->where('parent_id', '0')->where('lang',\App::getLocale())->orderBy('created_at', 'asc')->take(3)->get();
	}



}