<?php

namespace App\Http\Controllers\News\Admin;

use App\ContactUs;
use App\Http\Controllers\Controller;

use App\ModuleCat;
use App\NewsTags;
use App\Tag;
use App\UserCompany;
use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function aboutus($lang)
    {
        $aboutus = ContactUs::where('type', 'about')->where('lang', $lang)->orderBy('updated_at', 'desc')->firstOrFail();
        return view('_layouts.admin.about_us', compact('aboutus'));
    }

    public function aboutus_post(Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'text' => 'required',
            'lang' => 'required',
        ], [], [
            'address' => 'آدرس',
            'email' => 'ایمیل',
            'phone' => 'تلفن',
            'text' => 'متن',
            'lang' => 'زبان',
        ]);
        $aboutus = ContactUs::where('type', 'about')->where('lang', $request->lang)->orderBy('updated_at', 'desc')->firstOrFail();
        $aboutus->address = $request->address;
        $aboutus->email = $request->email;
        $aboutus->phone = $request->phone;
        $aboutus->descr = $request->descr;
        $aboutus->fulltext = $request->text;
        if ($aboutus->save()) {
            return [
                'ok' => true,
                'message' => '  به درستی ویرایش گردید',
            ];
        }

        return [
            'ok' => false,
            'message' => 'ثبت با مشکل رو برو شد!',
        ];

    }

    public function contactus()
    {
        return view('_layouts.admin.contact_us');
    }

    public function contactus_list(Request $request)
    {
        $query = ContactUs::where('type', 'contact');

        if ($request->has('filterRules')) {
            $filters = json_decode($request->get('filterRules'), true);
            foreach ($filters as $filter) {
                if ($filter['field'] == 'title')
                    $query->where($filter['field'], 'LIKE', "%{$filter['value']}%");
                elseif ($filter['field'] == 'status') {
                    $query->where($filter['field'], $filter['value']);
                } elseif ($filter['field'] == 'news_type') {
                    $query->where($filter['field'], $filter['value']);
                } elseif ($filter['field'] == 'slider') {
                    $query->where($filter['field'], $filter['value']);
                } elseif ($filter['field'] == 'published_at') {
                    $filter['value'] = \jDateTime::createDatetimeFromFormat('Y/m/d h:i:s', str_replace('  ', ' ', convertPersianToEnglishDigits($filter['value'])));
                    if ($filter['op'] == 'greater')
                        $query->where($filter['field'], '>', $filter['value']);
                    elseif ($filter['op'] == 'less')
                        $query->where($filter['field'], '<', $filter['value']);
                }
            }
        }

        $count = $query->count();
        $sort = $request->has('sort') ? $request->input('sort') : 'created_at';
        $order = $request->has('order') ? $request->input('order') : 'desc';
        $sorts = explode(',', $sort);
        $orders = explode(',', $order);
        foreach ($sorts as $key => $value) {
            $query->orderBy($value, $orders[$key]);
        }

        $page = $request->has('page') ? $request->input('page') : 1;
        $rows = $request->has('rows') ? $request->input('rows') : 10;
        $offset = ($page - 1) * $rows;

        return [
            'total' => $count,
            'rows' => $query->skip($offset)->take($rows)->get(['id', 'name', 'title', 'email', 'department', 'created_at', 'status']),
        ];

    }

    public function get_contactus(Request $request)
    {
        $aboutus = ContactUs::where('type', 'contact')->where('id', $request->post_id)->firstOrFail();
        $aboutus->status = 'read';
        $aboutus->save();
        return [
            'ok' => true,
            'data' => $aboutus->toArray()
        ];
    }

    public function contactus_delete(Request $request)
    {
        $aboutus = ContactUs::where('type', 'contact')->where('id', $request->post_id)->firstOrFail()->delete();
        return [
            'ok' => true,
        ];
    }

    public function index()
    {
        return view('news._admin.index');
    }

    public function slider_list()
    {
        return view('news._admin.slider');
    }

    public function create()
    {
        $cats = ModuleCat::where('module', 'news')->get();
        return view('news._admin.create', compact('cats'));
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $cats = ModuleCat::all();
        return view('news._admin.edit', compact('news', 'cats'));
    }

    public function _list(Request $request)
    {
        #$query = News::select('_id', 'title as txtTitle', 'created_at as c_at', 'visit', 'status')->where('user_id', '=', $request->user()->id);
        if (\Auth::user()->isadmin == 'yes')
            $query = News::select(['*']);
        else
            $query = News::where('user_id', $request->user()->id);

        if ($request->has('filterRules')) {
            $filters = json_decode($request->get('filterRules'), true);
            foreach ($filters as $filter) {
                if ($filter['field'] == 'title')
                    $query->where($filter['field'], 'LIKE', "%{$filter['value']}%");
                elseif ($filter['field'] == 'status') {
                    $query->where($filter['field'], $filter['value']);
                } elseif ($filter['field'] == 'news_type') {
                    $query->where($filter['field'], $filter['value']);
                } elseif ($filter['field'] == 'visit') {
                    $query->where($filter['field'], $filter['value']);
                } elseif ($filter['field'] == 'created_at') {
                    $filter['value'] = \jDateTime::createDatetimeFromFormat('Y/m/d h:i:s', str_replace('  ', ' ', convertPersianToEnglishDigits($filter['value'])));
                    if ($filter['op'] == 'greater')
                        $query->where($filter['field'], '>', $filter['value']);
                    elseif ($filter['op'] == 'less')
                        $query->where($filter['field'], '<', $filter['value']);
                }
            }
        }

        $count = $query->count();
        $sort = $request->has('sort') ? $request->input('sort') : 'created_at';
        $order = $request->has('order') ? $request->input('order') : 'desc';
        $sorts = explode(',', $sort);
        $orders = explode(',', $order);
        foreach ($sorts as $key => $value) {
            $query->orderBy($value, $orders[$key]);
        }

        $page = $request->has('page') ? $request->input('page') : 1;
        $rows = $request->has('rows') ? $request->input('rows') : 10;
        $offset = ($page - 1) * $rows;

        return [
            'total' => $count,
            'rows' => $query->skip($offset)->take($rows)->get(['id', 'title', 'created_at', 'visit', 'status']),
        ];

        $total = $query->count();
        #dd($query->get()->toArray());
        return [
            'total' => $total,
            'rows' => $query->get(['_id', 'title', 'created_at', 'visit', 'status']),
        ];
    }

    public function slider_list_post(Request $request)
    {
        $query = UserCompany::select(['id', 'company_name', 'brand', 'tel', 'slider_start_at', 'slider_end_at'])->where('slider', '!=', '');

        if ($request->has('filterRules')) {
            $filters = json_decode($request->get('filterRules'), true);
            foreach ($filters as $filter) {
                if ($filter['field'] == 'slider_start_at') {
                    $filter['value'] = \jDateTime::createDatetimeFromFormat('Y/m/d h:i:s', str_replace('  ', ' ', convertPersianToEnglishDigits($filter['value'])));
                    if ($filter['op'] == 'greater')
                        $query->where($filter['field'], '>', $filter['value']);
                    elseif ($filter['op'] == 'less')
                        $query->where($filter['field'], '<', $filter['value']);
                } elseif ($filter['field'] == 'slider_end_at') {
                    $filter['value'] = \jDateTime::createDatetimeFromFormat('Y/m/d h:i:s', str_replace('  ', ' ', convertPersianToEnglishDigits($filter['value'])));
                    if ($filter['op'] == 'greater')
                        $query->where($filter['field'], '>', $filter['value']);
                    elseif ($filter['op'] == 'less')
                        $query->where($filter['field'], '<', $filter['value']);
                } else {
                    $query->where($filter['field'], 'LIKE', "%{$filter['value']}%");
                }
            }
        }

        $count = $query->count();
        $sort = $request->has('sort') ? $request->input('sort') : 'created_at';
        $order = $request->has('order') ? $request->input('order') : 'desc';
        $sorts = explode(',', $sort);
        $orders = explode(',', $order);
        foreach ($sorts as $key => $value) {
            $query->orderBy($value, $orders[$key]);
        }

        $page = $request->has('page') ? $request->input('page') : 1;
        $rows = $request->has('rows') ? $request->input('rows') : 10;
        $offset = ($page - 1) * $rows;

        return [
            'total' => $count,
            'rows' => $query->skip($offset)->take($rows)->get(),
        ];
    }

    public function slider_list_put(Request $request)
    {
        $this->validate($request, [
            'cid' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ], [], [
            'cid' => 'انتخاب شرکت',
            'start_at' => 'تاریخ شروع',
            'end_at' => 'تاریخ پایان',

        ]);
        $query = UserCompany::where('id', $request->cid)->firstOrFail();
        $start_at = \jDateTime::createDatetimeFromFormat('Y/m/d h:i:s', str_replace('  ', ' ', convertPersianToEnglishDigits($request->start_at)));
        $end_at = \jDateTime::createDatetimeFromFormat('Y/m/d h:i:s', str_replace('  ', ' ', convertPersianToEnglishDigits($request->end_at)));

        if ($end_at <= $start_at)
            return [
                'ok' => false,
                'msg' => 'تاریخ پایان از تاریخ شروع بزرگ است.',
            ];

        $query->slider_start_at = $start_at;
        $query->slider_end_at = $end_at;
        $query->save();
        return [
            'ok' => true,
            'msg' => 'با موفقیت ثبت شد.',
        ];

    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'edit_id' => 'required',
            'title' => 'required',
//            'summary' => 'required',
            'text' => 'required',
//            'file_pic' => 'required_if:type,titr1|titr2',
            'lang' => 'required',
            #'cat' => 'required',
            'type' => 'required',
        ], [], [

            'edit_id' => 'عنوان',
            'title' => 'عنوان',
//            'summary' => 'لید',
            'text' => 'متن',
//            'file_pic' => ' تصویر خبر',
            'lang' => 'زبان',
            #'cat' => 'دسته بندی',
            'type' => 'نوع خبر',
        ]);

        if ($request->type == 'titr1' || $request->type == 'titr2')
            $this->validate($request, [
                'file_pic' => 'required',
            ], [], [
                'file_pic' => ' تصویر خبر',
            ]);

        $tags = $request->tags;
        $tags_id = [];
        $sync_data = [];
        foreach ($tags as $tag) {
            if (trim($tag) != '') {
                if (\Auth::user()->isadmin == 'yes'){
					$tag_q = Tag::firstOrCreate(['user_id' => $request->user()->id, 'title' => $tag]);
					$tags_id[] = $tag_q->id;
				}
				else{
					$tag_q = Tag::where('title' , $tag)->first();
					$tags_id[] = $tag_q->id;
				}
//                $sync_data[$tag_q->id] = ['user_id' => $request->user()->id];
            }
        }

        $news = News::find($request->edit_id);
        $news->lang = $request->lang;
        $news->title = $request->title;
        $news->descr = $request->summary;
        $news->full_text = $request->text;
        #$news->user_id = $request->user()->id;
        $news->cat_id = 0;
        #$news->cat_id = $request->cat;
        /*
        if (\Auth::user()->isadmin == 'yes')
            $news->status = 'active';
        else
            $news->status = 'deactive';
        */
        $news->type = $request->type;
        $news->slider = $request->slider;
        $news->image_url = $request->file_pic;
        $news->tags = implode(',', $tags_id);
        $news->created_at = \jDateTime::createDateTimeFromFormat('Y/m/d h:i:s', convertPersiantoEnglishDigits($request->date));
        $news->created_at_fa = convertPersiantoEnglishDigits($request->date);

        if ($news->save()) {

            NewsTags::where('news_id' , $news->id )->delete();
            foreach ($tags_id as $tag_id){
                $nt = new NewsTags();
                $nt->news_id = $news->id ;
                $nt->tag_id = $tag_id ;
                $nt->user_id = $request->user()->id ;
                $nt->save();
            }
//            $news->tags()->sync($sync_data);

            return [
                'ok' => true,
                'message' => 'خبر  به درستی ویرایش گردید',
            ];
        }

        return [
            'ok' => false,
            'message' => 'ثبت با مشکل رو برو شد!',
        ];
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required',

        ], [], [
            'post_id' => 'عنوان',
        ]);

        if (\Auth::user()->isadmin == 'yes') {
            if (News::destroy($request->post_id)) {
                return [
                    'ok' => true,
                    'message' => 'حذف خبر با موفقیت انجام شد',
                ];
            }
        } else
            return [
                'ok' => false,
                'message' => 'خطا در حذف خبر!',
            ];

    }

    public function deactive(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required',

        ], [], [
            'post_id' => 'عنوان',
        ]);

        if(\Auth::user()->isadmin == 'yes') {
            $news = News::findOrFail($request->post_id);
            if ($news->status == 'deactive')
                $news->status = 'active';
            else
                $news->status = 'deactive';

            if ($news->save()) {
                return [
                    'ok' => true,
                    'message' => 'تغییر وضعیت خبر با موفقیت انجام شد',
                ];
            }
        }
        return [
            'ok' => false,
            'message' => 'خطا !',
        ];

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
//            'summary' => 'required',
            'text' => 'required',
//            'file_pic' => 'required_if:type,titr1|titr2',
            'lang' => 'required',
           # 'cat' => 'required',
            'tags' => 'required',
        ], [], [
            'title' => 'عنوان',
            'text' => 'متن',
//            'summary' => 'خلاصه ی خبر',
//            'file_pic' => 'تصویر',
            'type' => 'نوع خبر',
            'lang' => 'زبان',
            #'cat' => 'دسته بندی',
            'tags' => 'تگ',
        ]);

        if ($request->type == 'titr1' || $request->type == 'titr2')
            $this->validate($request, [
                'file_pic' => 'required',
            ], [], [
                'file_pic' => ' تصویر خبر',
            ]);

        $tags = $request->tags;
        $tags_id = [];
        $sync_data = [];
        foreach ($tags as $tag) {
            if (trim($tag) != '') {
                if (\Auth::user()->isadmin == 'yes'){
					$tag_q = Tag::firstOrCreate(['user_id' => $request->user()->id, 'title' => $tag]);
					$tags_id[] = $tag_q->id;
				}
				else{
					$tag_q = Tag::where('title' , $tag)->first();
					$tags_id[] = $tag_q->id;
				}
//                $sync_data[$tag_q->id] = ['user_id' => $request->user()->id];
            }
        }

        $news = new News();
        $news->lang = $request->lang;
        $news->title = $request->title;
        $news->descr = $request->summary;
        $news->full_text = $request->text;
        $news->user_id = $request->user()->id;
       # $news->cat_id = $request->cat;
        $news->cat_id = 0;
        $news->type = $request->type;
        $news->slider = $request->slider;
        $news->image_url = $request->file_pic;
        if (\Auth::user()->isadmin == 'yes')
            // $news->status = 'active';
            $news->status = 'deactive';
        else
            $news->status = 'deactive';
        $news->visit = 0;
        $news->tags = implode(',', $tags_id);
        $news->created_at = \jDateTime::createDateTimeFromFormat('Y/m/d h:i:s', convertPersiantoEnglishDigits($request->date));
        $news->created_at_fa = convertPersiantoEnglishDigits($request->date);

        if ($news->save()) {

//            $news->tags()->sync($sync_data);
            NewsTags::where('news_id' , $news->id )->delete();
            foreach ($tags_id as $tag_id){
                $nt = new NewsTags();
                $nt->news_id = $news->id ;
                $nt->tag_id = $tag_id ;
                $nt->user_id = $request->user()->id ;
                $nt->save();
            }
            
            return [
                'ok' => true,
                'message' => 'خبر جدید به درستی ثبت گردید',
            ];
        }

        return [
            'ok' => false,
            'message' => 'ثبت با مشکل رو برو شد!',
        ];

    }

}