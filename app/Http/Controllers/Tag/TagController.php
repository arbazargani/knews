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
        $news_titr2 = $tag->news()->where('status', 'active')->where('type', 'titr2')->where('news.created_at', '<=', $nowdate)->where('lang', \App::getLocale())->orderBy('created_at', 'desc')/*->take(3)*/->get();
        if ($id == 1)
            $news_titr3 = $tag->news()->where('status', 'active')->where('type', 'titr3')->where('news.created_at', '<=', $nowdate)->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take(50)->get();
        else
            $news_titr3 = $tag->news()->where('status', 'active')->where('type', 'titr3')->where('news.created_at', '<=', $nowdate)->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->get();

        return view(\App::getLocale() . '.home_tag', compact('tag', 'news_titr1', 'news_titr2', 'news_titr3'));
    }

}
