<?php

namespace App\Http\Controllers\Tag;

use App\News;
use App\NewsTags;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function items()
    {
        $tags = Tag::orderBy('order', 'desc')->orderBy('title', 'asc')->orderBy('id', 'desc')
            ->get();
        #->paginate(120);
        return view(\App::getLocale() . '.tags_list', compact('tags'));
    }

    public function show($id, $title)
    {
        $nowdate = Carbon::now()->toDateTimeString();
        $tag = Tag::findOrFail($id);

        $news_titr1 = $tag->news()->where('status', 'active')->where('type', 'titr1')->where('news.created_at', '<=', $nowdate)->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take(6)->get();
        $news_titr2 = $tag->news()->where('status', 'active')->where('type', 'titr2')->where('news.created_at', '<=', $nowdate)->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take(6)->get();
        if ($id == 1)
            $news_titr3 = $tag->news()->where('status', 'active')->where('type', 'titr3')->where('news.created_at', '<=', $nowdate)->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take(50)->get();
        else
            $news_titr3 = $tag->news()->where('status', 'active')->where('type', 'titr3')->where('news.created_at', '<=', $nowdate)->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take(30)->get();

        return view(\App::getLocale() . '.home_tag', compact('tag','news_titr1', 'news_titr2', 'news_titr3'));
    }

    public function jsonLoadMore($id, $page)
    {
        // if (date('s')%2 == 0) {
        //     return;
        // }
        $tag = Tag::findOrFail($id);
        $page = ($page == 0) ? 1 : $page;
        $nowdate = Carbon::now()->toDateTimeString();
        $news_titr2 = $tag->news()->where('status', 'active')
            ->where('type', 'titr2')
            ->where('news.created_at', '<=', $nowdate)
            ->where('lang', \App::getLocale())
            ->orderBy('created_at', 'desc')
            ->skip(6 * $page)
            ->take(6)
            ->get();
        $row = [
            "content" => '',
            "next" => ''
        ];
        foreach ($news_titr2 as $data) {
            $title = $data->title;
            $slug = $this->str_slug_fa($data->title);
            $img_src = $this->image_url($data->image_url, 235, 100, true);
            $href = route('news.show', [$data->id, $slug]);
            $desc = $data->descr;

            $row['content'] .= "
                <div class='newsListItem'>
                    <div id=''
                        class='newsImage pull-right ' style='width: 100%'>
                        <a id=''
                            title=''
                            href='$href'
                            target='_parent'>
                        <img
                            id=''
                            title='$title' class='img-responsive img-thumbnail'
                            src='$img_src'
                            alt='$title' style='border-width:0px;/*width: 100%*/'/></a>
                    </div>
                    <div id=''
                        class='newsListTitle'>
                        <h3>
                            <a href='$href'
                                target='_parent'>$title</a>
                        </h3>
                    </div>
                    <div id=''
                        class='newsListLead lead'>
                        <span id=''
                            class='leadContent'>
                        $desc
                        </span>
                        <a id=''
                            title='...' class='newsLeadMore'
                            href='$href' 
                            target='_parent'>...</a>
                    </div>
                </div>
                ";
            $row['next'] = $page + 1;
        }
        // return response()->json($row);
        echo $row['content'];
    }

    function str_slug_fa($title, $separator = '-')
    {
        // Convert all dashes/underscores into separator
        $flip = $separator == '-' ? '_' : '-';
        $title = preg_replace('![' . preg_quote($flip) . ']+!u', $separator, $title);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $title = preg_replace('![^' . preg_quote($separator) . '\pL\pN\s]+!u', '', mb_strtolower($title));

        // Replace all separator characters and whitespace by a single separator
        $title = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $title);

        return trim($title, $separator);
    }


    function image_url($file, $width = 0, $height = 0, $crop = true)
    {
        $info = pathinfo($file);#dd($info);

        if (count($info) == 4) {
            if (substr($info['dirname'], 0, 6) == 'files/') {
                $info['dirname'] = substr($info['dirname'], 6);
            }


            //return 'http://preview.ir:81/'.("images/{$info['dirname']}/{$info['filename']}" . ($crop ? '_' : '-') . "{$width}x{$height}.{$info['extension']}");
            return url("images/{$info['dirname']}/{$info['filename']}" . ($crop ? '_' : '-') . "{$width}x{$height}.{$info['extension']}");
        }

        return url($file);


    }
}
