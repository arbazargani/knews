<?php

function locality(){

    $locale = Request::segment(1);

    if ( array_key_exists($locale, config('app.locales'))) {
        App::setLocale($locale);
    }
    App::setLocale(config('app.locale'));

}

function str_slug_fa($title, $separator = '-')
{
    // Convert all dashes/underscores into separator
    $flip = $separator == '-' ? '_' : '-';
    $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

    // Remove all characters that are not the separator, letters, numbers, or whitespace.
    $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($title));

    // Replace all separator characters and whitespace by a single separator
    $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

    return trim($title, $separator);
}


function image_url($file, $width = 0, $height = 0, $crop = true)
{
	$info = pathinfo($file);#dd($info);

    if (count($info) == 4)
    {
		if (substr($info['dirname'], 0, 6) == 'files/') {
            $info['dirname'] = substr($info['dirname'], 6);
		}


		//return 'http://preview.ir:81/'.("images/{$info['dirname']}/{$info['filename']}" . ($crop ? '_' : '-') . "{$width}x{$height}.{$info['extension']}");
		return url("images/{$info['dirname']}/{$info['filename']}" . ($crop ? '_' : '-') . "{$width}x{$height}.{$info['extension']}");
	}

	return url($file);
}

function is_superadmin(){
    if(\Auth::User()->superadmin === true)
        return true;
    else return false;
}

function userAccess($module_name, $permissions = [], $is_die = true)
{
    #dd( extractSubdomains(Request::server('HTTP_HOST')) );
    #dd(Request::server('HTTP_HOST'));
    #dd($permissions);
	#dd($module_name);

	/*$data = \App\User::raw(function ($collection) {
		return $collection->aggregate([
			['$match' => ['portal.url' => $_SERVER['SERVER_NAME']]],
			['$unwind' => '$portal'],
			['$match' => ['portal.url' => $_SERVER['SERVER_NAME']]],
		]);
	});*/

    $data = array_where(\Auth::user()->portal , function($key,$val){
        return  ( strstr(portal_alias(),$val['url']) !== FALSE );
    });

    #dd(\Auth::user()->portal);
    #dd($data);
    $data = (reset($data));
    if ($data['permission'] === true)
        return true; // User Access All Permission & modules ,  super user

    elseif (!empty($data['permission'][$module_name])) {

        if($data['permission'][$module_name] === true)
            return true;// User Access All Permission for module

        if (empty($permissions)) // for route group
            return true;
        else {
            if (!is_array($permissions))
                $permissions = [$permissions];
            foreach ($permissions as $permission) {
                $result = false;
                foreach ($data['permission'][$module_name] as $db_permission)
                    if($permission==$db_permission) {
                        $result = true;
                        break;
                    }
                if(!$result)
                    break;
                /*if (in_array($permission, $data[$module_name]))
                    return true;*/
            }
            return $result;
        }
    }

  /*  $data = \Auth::user()->permission;
	if ($data === true)
		return true; // User Access All Permission & module
	elseif (!empty($data[$module_name])) {



		if($data[$module_name] === true)
			return true;// User Access All Permission for module
		if (empty($permissions))
			return true;// User Access All Permission for module
		else {
			if (!is_array($permissions))
				$permissions = [$permissions];
			foreach ($permissions as $permission) {
				if (in_array($permission, $data[$module_name]))
					return true;
			}
		}
	}*/
	if ($is_die)
		abort(403);

    return false;
}

function seoTools(){

    $value = Cache::remember('seo_'.$_SERVER['HTTP_HOST'] ,30, function(){
        $ad = \App\AliasDomain::where('domain',portal_alias())->where('seo.'.App::getLocale(), 'exists', true)->first();
        if(isset($ad->seo[App::getLocale()]))
            return $ad->seo[App::getLocale()];
        else
            return [
                'title'=>'',
                'keyword'=>'',
                'description'=>'',
            ];
    });
    return $value;
}

function portal_alias(){

    $re = \App\AliasDomain::where('alias',$_SERVER['HTTP_HOST'])->firstOrfail();
    return $re->domain;

    $value = Cache::remember('portal_alias_'.$_SERVER['HTTP_HOST'] ,30, function(){
        $re = \App\AliasDomain::where('alias',$_SERVER['HTTP_HOST'])->firstOrfail();
        return $re->domain;
    });
    return $value;
}

function portal_alias_type(){

    $re = \App\AliasDomain::where('alias',$_SERVER['HTTP_HOST'])->firstOrfail();
    return $re->type;
    
    $value = Cache::remember('portal_alias_type_'.$_SERVER['HTTP_HOST'] ,30, function(){
        $re = \App\AliasDomain::where('alias',$_SERVER['HTTP_HOST'])->firstOrfail();
        return $re->type;
    });
    return $value;
}

function access($attr, $path, $data, $volume)
{
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		: null;                                    // else elFinder decide it itself
}

function ElfinderConfig($opts = [])
{
	$path = base_path('libraries/elFinder/');
	include_once $path . 'elFinderConnector.class.php';
	include_once $path . 'elFinder.class.php';
	include_once $path . 'elFinderVolumeDriver.class.php';
	include_once $path . 'elFinderVolumeLocalFileSystem.class.php';

	// run elFinder
	$connector = new elFinderConnector(new elFinder($opts));
	$connector->run();

}

function asset_generate($attributes, $type)
{
	if( is_array($attributes) )
	{
		if($type == 'style')
			$file = $attributes['href'];
		elseif($type == 'script')
			$file = $attributes['src'];
		else
			return false;
	}
	else
	{
		$file = $attributes;
		$attributes = [];
	}

    if( !\Session::has('assets.'. $file) )
    {
		//\Session::flash('assets.'. $file, true);

        return \Cache::get($file, function () use ($file, $attributes, $type)
        {
            $path = public_path('assets/' . $file);
            $link = asset('assets/' . $file);

            if (file_exists($path))
            {
                $link .= '?' . filemtime($path);
                if (getenv('APP_DEBUG') ?: false)
                    $expiresAt = \Carbon\Carbon::now()->addWeek();
                else
                    $expiresAt = \Carbon\Carbon::now()->addMinutes(1);
            }
            else
                $expiresAt = \Carbon\Carbon::now()->addMinutes(1);

			switch($type)
			{
				case 'style':
					unset($attributes['href']);
					$attributes = array_merge([
						'rel' => 'stylesheet',
						'type' => 'text/css',
					], $attributes);

					$html = "<link href=\"{$link}\"";
					foreach($attributes as $key => $value)
						$html .= " {$key}=\"{$value}\"";

					$html .= ' />';
					break;
				case 'script':
					unset($attributes['src']);

					$html = "<script src=\"{$link}\"";
					foreach($attributes as $key => $value)
						$html .= " {$key}=\"{$value}\"";

					$html .= '></script>';
					break;
			}

			if( !empty($html) )
			{
				#Cache::add($file, $html, $expiresAt);
				return $html;
			}

			return false;
        });
    }

	return false;
}

function cleanURL($url)
{
    $st = rtrim($url, '\/');
    $st = strtolower($url);
    $st = str_replace("http://", "", $st);
    $st = str_replace("https://", "", $st);
    $st = ltrim($url, 'www.');
    $st = str_replace("ftp://", "", $st);
    $st = trim($st);

    return $st;
}

function convertPersiantoEnglishDigits ($string) {
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $num = range(0, 9);
    return str_replace($persian, $num, $string);
}

function extractDomain($domain)
{
    if (preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $domain, $matches)) {
        return $matches['domain'];
    } else {
        return $domain;
    }
}

function extractSubdomains($domain)
{
    $pos = strpos($domain,':');
    if($pos !== FALSE){
        $domain = substr($domain,0,$pos);
    }
    $subdomains = $domain;
    $domain = extract_domain($subdomains);
    $subdomains = rtrim(strstr($subdomains, $domain, true), '.');
    return $subdomains;
}

function extract_domain($domain)
{
    if(preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $domain, $matches))
    {
        return $matches['domain'];
    } else {
        return $domain;
    }
}

function gp_url($product){
	return url("/Product/sm-{$product->number}/".str_replace(" ","-",$product->name_english)."/".str_replace(" ", "-",$product->name_farsi));
}

function discount_percent($product){
	$new = $product['price'] - $product['discount'];
	return ceil(100-($new*100/$product['price']));
}

function is_image($path) {
    $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
    $contentType = mime_content_type($path);

    if( in_array($contentType, $allowedMimeTypes) )
        return true;
    return false;
}

function is_movie($path) {
    $allowedMimeTypes = ['video/mp4'];
    $contentType = mime_content_type($path);

    if( in_array($contentType, $allowedMimeTypes) )
        return true;
    return false;
}

function is_audio($path) {
    $allowedMimeTypes = ['video/mp3'];
    $contentType = mime_content_type($path);

    if( in_array($contentType, $allowedMimeTypes) )
        return true;
    return false;
}

function blob_blob($text,$size = 200){
    if(mb_strlen($text)>$size)
        return mb_substr($text,0,$size) . ' ...';
    return $text;
}

function main_domain()
{
    $domain_parts = (explode('.', $_SERVER['HTTP_HOST']));

    if (count($domain_parts) > 3 || count($domain_parts) > 2) {
        if ($domain_parts[count($domain_parts) - 2] == 'ac') {
            unset ($domain_parts[0]);
            $main_url = (implode('.', $domain_parts));
        } else {
            unset ($domain_parts[0]);
            $main_url = (implode('.', $domain_parts));

        }
    } else
        $main_url = $_SERVER['HTTP_HOST'];
    return $main_url;
}