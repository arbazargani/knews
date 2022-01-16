<?php

namespace App\Http\Controllers\News;

use App\Http\Requests\NewsRequest;
use App\ModuleCat;
use App\News;
use App\NewsTags;
use App\StaticPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{

    public function index(Request $request)
    {
        $rows = $request->input('rows', 9);
        $query = News::where('status', 'active')/*->where('slider', 'no')*/
        ->where('lang', \App::getLocale());
        $news = $query->paginate($rows);
        return view(\App::getLocale() . '.news_list', compact('news'));
    }

    public function show(Request $request)
    {
        $news = News::with('tags')->where('status','active')->findOrFail($request->id);
        $news_id =  NewsTags::whereIn('tag_id',explode(',',$news->tags))->pluck('news_id')  ;
		$tags = \App\Tag::whereIn('id',explode(',',$news->tags))->get();
        $news_id = array_unique($news_id->toArray());
        $news_related = News::whereIn('id',$news_id)->orderByRaw('rand()')->take(40)->get();
        $news->visit = $news->visit + 1;
        $news->save();

        return view(\App::getLocale() . '.news_lnfo', compact('news', 'news_related','tags'));
    }

    public function page_show(Request $request)
    {
        $news = StaticPage::findOrFail($request->id);
        $news->visit = $news->visit + 1;
        $news->save();
        return view(\App::getLocale() . '.news_lnfo', compact('news'));
    }

    public function page_list(Request $request)
    {
        $cat = ModuleCat::where('module', 'staticpage')->where('id', $request->id)->firstOrFail();

        $rows = $request->input('rows', 9);
        $query = StaticPage::where('cats', $request->id)->where('status', 'active')/*->where('slider', 'no')*/
        ->where('lang', \App::getLocale());
        $news = $query->paginate($rows);

        #$news = StaticPage::where('cats' , $request->id )->where('status', 'active')/*->where('slider', 'no')*/->where('lang', \App::getLocale())->get();
        return view(\App::getLocale() . '.static_list', compact('news', 'cat'));
    }

    public function search_news(Request $request)
    {
        if ($request->q == '' || is_null($request->q))
            return redirect(url('/'));
        $qs = trim($request->q);
        $news = \App\News::where('portal', portal_alias())
            ->where('status', 'active')
            ->orWhere('title', 'like', '%' . $qs . '%')
            ->orWhere('descr', 'like', '%' . $qs . '%')
            ->paginate(10);

        $domain = $request->domain;
        $subdomain = $request->subdomain;
        return view('news.list', compact('news', 'subdomain', 'domain'));

    }

    public function archive_notifications(Request $request)
    {
        $domain = $request->domain;
        $subdomain = $request->subdomain;

        $news = [];
        $news_notification_cat = \App\NewsCat::where('title', "اطلاعیه‌ها")->where('portal', portal_alias())->first();
        if (count($news_notification_cat) > 0) {
            $news_notification_cat_id = $news_notification_cat->_id;
            $news = \App\News::where('module', 'news')->where('status', 'active')->where('cat_id', $news_notification_cat_id)->get();
        }

        return view('news.list', compact('news', 'domain', 'subdomain'));


    }


    ###############    CAT  ##############
    public function cat_list(Request $request, $id, $title)
    {
        dd($request->id);
    }

}
