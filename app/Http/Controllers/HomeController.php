<?php

namespace App\Http\Controllers;

use App\ContactUs;
use App\Course;
use App\News;
use App\Newsletter;
use App\Product;
use App\StaticPage;
use App\User;
use App\UserCompany;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $take = 20;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->path() == 'fa') {
        	return redirect('/');
        }
        $nowdate = Carbon::now()->toDateTimeString();
        $news_titr1 = News::where('status', 'active')->where('type', 'titr1')->where('created_at', '<=' , $nowdate )->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take(3)->get();
        // $news_titr2 = News::where('status', 'active')->where('type', 'titr2')->where('created_at', '<=' , $nowdate )->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take(8)->get();
        $news_titr2 = News::where('status', 'active')->where('type', 'titr2')->where('created_at', '<=' , $nowdate )->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take(13)->get();
        $news_titr3 = News::where('status', 'active')->where('type', 'titr3')->where('created_at', '<=' , $nowdate )->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take(60)->get();
        
        $random_news = \App\News::where('created_at', 'like', '%2018%')
        ->where('status', 'active')
        ->where('type', 'titr2')
        ->where('lang', \App::getLocale())
        ->inRandomOrder()
        ->limit(5)->get();
        return view(\App::getLocale() . '.home',compact('news_titr1','news_titr2','news_titr3', 'random_news'));
    }

    public function aboutus()
    {
        $aboutus = ContactUs::where('type', 'about')->where('lang', \App::getLocale())->orderBy('updated_at', 'desc')->firstOrFail();
        return view(\App::getLocale() . '.aboutus', compact('aboutus'));
    }

    public function contactus()
    {
        $aboutus = ContactUs::where('type', 'about')->where('lang', \App::getLocale())->orderBy('updated_at', 'desc')->firstOrFail();
        return view(\App::getLocale() . '.contactus', compact('aboutus'));
    }

    public function newsletter_store(Request $request)
    {
        if( Newsletter::where('email',$request->tm_newsletter_email)->count() == 0 ){

            $nl = new Newsletter;
            $nl->email = $request->tm_newsletter_email;
            $nl->save();
            return [
                'ok' => true,
                'msg' => trans('custom.successfully_subscribed')
            ];
        }

        return [
            'ok' => false,
            'msg'=>trans('custom.old_successfully_subscribed')
        ];

    }

    public function contactus_post(Request $request)
    {
        $this->validate($request, [
            #'department' => 'required',
            #'name' => 'required',
            #'title' => 'required',
            #'phone' => 'required',
            'email' => 'required|email',
            'text' => 'required',
        ], [], [
            #'department' => trans('custom.department'),
            #'name' => trans('auth.name'),
            #'title' => trans('custom.title'),
            'email' => trans('auth.email'),
            #'phone' => trans('auth.tel'),
            'text' => trans('custom.text'),
        ]);

        $aboutus = new ContactUs;
        $aboutus->name = 'a';#$request->name;
        $aboutus->title = 'a';#$request->title;
        $aboutus->email = $request->email;
        $aboutus->phone = 'a';#$request->phone;
        $aboutus->address = '';
        $aboutus->descr = '';
        $aboutus->ip = $request->ip();
        $aboutus->fulltext = $request->text;
        $aboutus->department = 'support' ;#$request->department;
        $aboutus->type = 'contact';
        $aboutus->lang = \App::getLocale();
        if ($aboutus->save()) {

            return view('fa.contactus')->with('successMsg','پیام با موفقیت ارسال شد. با تشکر');
        }

        return view('fa.contactus');

    }

    public function search(Request $request)
    {
        $txtsearch = $request->q;
        $news = News::where('status','active')
            ->where(function ($q) use($txtsearch){
                return $q->where('title', 'like', '%' . $txtsearch . '%')
                    ->orWhere('descr', 'like', '%' . $txtsearch . '%')
                    ->orWhere('full_text', 'like', '%' . $txtsearch . '%')
                ;
            })
            ->orderBy('created_at', 'desc')
            ->paginate(500);
            #->paginate($this->take);
        $text = 'کلمه ی جستجویی شما : ' . $txtsearch ;
        return view(\App::getLocale() . '.news_search_list', compact('news', 'text'));
    }

    public function archive(Request $request)
    {
        $news = News::select(['created_at','created_at_fa'])->groupBy(\DB::raw('YEAR(created_at_fa)'))
        ->orderBy('created_at_fa','asc')
        #->toSql();
        ->paginate($this->take);
        #dd($news);

        $text = 'آرشیو سالانه تمام مطالب سایت ' ;
        return view(\App::getLocale() . '.news_archive', compact('news', 'text'));
    }
    public function archive_month(Request $request)
    {
        $month_name = $request->month;

        /*$month_name = 'فروردین' ;
        switch ($request->month) {
            case 1 :
                $month_name = 'فروردین';
                break;
            case 2 :
                $month_name = 'اردیبهشت';
                break;
            case 3 :
                $month_name = 'خرداد';
                break;
            case 4 :
                $month_name = 'تیر';
                break;
            case 5 :
                $month_name = 'مرداد';
                break;
            case 6 :
                $month_name = 'شهریور';
                break;
            case 7 :
                $month_name = 'مهر';
                break;
            case 8 :
                $month_name = 'آبان';
                break;
            case 9 :
                $month_name = 'آذر';
                break;
            case 10 :
                $month_name = 'دی';
                break;
            case 11 :
                $month_name = 'بهمن';
                break;
            case 12 :
                $month_name = 'اسفند';
                break;
        }*/

        $news = News::where('status','active')
            ->whereYear('created_at_fa',$request->month)
            ->orderBy('created_at_fa', 'desc')
            #->get();
            ->paginate(1000000000);
        $text = 'آرشیو تمام مطالب  سال' . $month_name ;
        return view(\App::getLocale() . '.news_search_list', compact('news', 'text'));
    }

    public function newsletter(Request $request)
    {
        $us = User::find(\Auth::user()->id);
        if ($us->newsletter == 'yes')
            $us->newsletter = 'no';
        else
            $us->newsletter = 'yes';
        $us->save();

        return redirect(route('profile.index'));
    }

    public function render_files($filename) {
        // open the file in a binary mode
        $name = 'http://ketabnews.com/files/' . $filename;
        $fp = fopen($name, 'rb');
        
        // send the right headers
        header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
        header('Expires: January 01, 2013'); // Date in the past
        header('Pragma: no-cache');
        header("Content-Type: image/jpg");
        /* header("Content-Length: " . filesize($name)); */
        
        // dump the picture and stop the script
        fpassthru($fp);
        die();
        exit;
    }
    
    public function render_videoFiles($dir, $filename, $ext) {
        
        // open the file in a binary mode
        $name = "http://ketabnews.com/files/$dir/$filename.$ext";
        $fp = fopen($name, 'rb');
        
        // send the right headers
        header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
        header('Expires: January 01, 2013'); // Date in the past
        header('Pragma: no-cache');
        header("Content-Type: video/$ext");
        /* header("Content-Length: " . filesize($name)); */
        
        // dump the picture and stop the script
        fpassthru($fp);
        die();
        exit;
    }
    
    public function render_images($filename) {
        // open the file in a binary mode
        $name = 'http://ketabnews.com/images/' . $filename;
        $fp = fopen($name, 'rb');
        
        // send the right headers
        header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
        header('Expires: January 01, 2013'); // Date in the past
        header('Pragma: no-cache');
        header("Content-Type: image/jpg");
        /* header("Content-Length: " . filesize($name)); */
        
        // dump the picture and stop the script
        fpassthru($fp);
        die();
        exit;
    }

    public function jsonLoadMore($page) {
        if (date('s')%2 == 0) {
            return;
        }
        $page = ($page == 0) ? 1 : $page;
        $nowdate = Carbon::now()->toDateTimeString();
        $news_titr2 = News::where('status', 'active')
        ->where('type', 'titr2')
        ->where('created_at', '<=' , $nowdate )
        ->where('lang', \App::getLocale())
        ->orderBy('created_at', 'desc')
        ->skip(6*$page)
        ->take(6)
        ->get();
        $row = [
            "content" => '',
            "next" => ''
        ];
        foreach($news_titr2 as $data) {
            $title = $data->title;
            $slug = $this->str_slug_fa($data->title);
            $img_src = $this->image_url($data->image_url , 235,100 ,true);
            $href = route('news.show', [$data->id , $slug]);
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
                $row['next'] = $page+1;
        }
        // return response()->json($row);
        echo $row['content'];
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
}