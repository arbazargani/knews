<?php

namespace App\Http\Controllers;

use Request;
use Image;

class FileController extends Controller
{
	public function create($image, $type, $width, $height, $ext)
	{
		#dd(public_path('files/' . $image . '.' . $ext));
		#if( !empty(Request::server('HTTP_REFERER')) && file_exists( public_path('files' . $image . '.' . $ext) ) )
		if( file_exists( public_path('files/' . $image . '.' . $ext) ) )
		{

			$w = $width * 1;
			if($w <= 0) $w = null;

			$h = $height * 1;
			if($h <= 0) $h = null;

			if($w > 2000000000 || $h > 1500000000000)
				abort(404);

            /*$img = Image::cache(function($image) use ($ext) {
                #return $image->make('public/foo.jpg')->resize(300, 200)->greyscale();
                return Image::make(public_path('' . $image . '.' . $ext));
            });*/
            $img = Image::make(public_path('files/' . $image . '.' . $ext));
			switch($type)
			{
				case '_':

					if($w == null || $h == null)
						abort(404);
					else
					{

						$img->fit($w, $h);
					}
					break;
				case '-':
					if( $w != null && $h == null)
						$img->widen($w);
					elseif( $w == null && $h != null)
						$img->heighten($h);
					elseif($w != null && $h != null)
					{
						$img->resize($w, $h, function ($constraint) {
							$constraint->aspectRatio();
							#$constraint->upsize();
						});
					}

					break;
				default:
					abort(404);
			}

			@mkdir( dirname( public_path("images{$image}.{$ext}") ), 0755, true );
			$img->save("images{$image}{$type}{$width}x{$height}.{$ext}");
			return $img->response($ext);
		}

		abort(404);
	}
}
