<?php

namespace App\Http\Controllers\Staticpage\Admin;

use App\ModuleCat;
use App\StaticPage;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaticpageController extends Controller
{
    public function index()
    {
        return view('staticpage._admin.index_all');
    }

    public function create()
    {
        $cats = ModuleCat::where('module','staticpage')/*->where('parent_id','!=','0')*/->get();
        return view('staticpage._admin.create' , compact('cats') );
    }

    public function admin_edit($id)
    {
        $news = StaticPage::findOrFail($id);
        $cats = ModuleCat::where('module','staticpage')->get();
        return view('staticpage._admin.edit', compact('news','cats'));
    }

    public function _list(Request $request)
    {
        $query = StaticPage::where('user_id', '=', $request->user()->id);

        if ($request->has('filterRules')) {
            $filters = json_decode($request->get('filterRules'), true);
            foreach ($filters as $filter) {
                if ($filter['field'] == 'title')
                    $query->where($filter['field'], 'LIKE', "%{$filter['value']}%");
                elseif ($filter['field'] == 'status') {
                    $query->where($filter['field'], $filter['value']);
                } elseif ($filter['field'] == 'visit') {
                    $query->where($filter['field'], $filter['value']);
                }
                elseif ($filter['field'] == 'created_at') {
                    $filter['value'] = \jDateTime::createDatetimeFromFormat('Y/m/d h:i:s', str_replace('  ', ' ', convertPersianToEnglishDigits($filter['value'])));
                    if ($filter['op'] == 'greater')
                        $query->where($filter['field'], '>', $filter['value']);
                    elseif ($filter['op'] == 'less')
                        $query->where($filter['field'], '<', $filter['value']);
                }
                else
                    $query->where($filter['field'], 'LIKE', "%{$filter['value']}%");
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
            'rows' => $query->skip($offset)->take($rows)->get(['id', 'title','lang', 'created_at', 'visit', 'status']),
        ];

    }

    public function admin_update(Request $request)
    {
        $this->validate($request, [
            'edit_id' => 'required',
            'title' => 'required',
            'summary' => 'required',
            'text' => 'required',
            'file_pic' => 'required',
            'lang' => 'required',
        ], [], [
            'edit_id' => 'عنوان',
            'title' => 'عنوان',
            'summary' => 'خلاصه مطلب',
            'text' => 'متن',
            'file_pic' => 'تصویر مطلب',
            'lang' => 'زبان',
        ]);

        $tags =  $request->tags;
        $tags_id = [];
        if(!empty($tags))
            foreach ($tags as $tag) {
                if (trim($tag) != '') {
                    $tag_q = Tag::firstOrCreate(['user_id' => $request->user()->id, 'title' => $tag]);
                    $tags_id[] = $tag_q->id;
                }
            }


        $news = StaticPage::find($request->edit_id);
        $news->lang = $request->lang;
        $news->title = $request->title;
        $news->descr = $request->summary;
        $news->full_text = $request->text;
        $news->user_id = $request->user()->id;
        $news->image_url = $request->file_pic;
        $news->status = 'active';
        $news->show_part = $request->show_part;
        $news->visit = 0 ;
        $news->cats = isset($request->sub_cat)?$request->sub_cat : 0 ;
        $news->tags = implode(',', $tags_id );


        if ($news->save()) {

            return [
                'ok' => true,
                'message' => 'مطلب به درستی ثبت گردید',
            ];
        }

        return [
            'ok' => false,
            'message' => 'ثبت با مشکل رو برو شد!',
        ];
    }

    public function admin_destroy(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required',

        ], [], [
            'post_id' => 'عنوان',
        ]);

        if (StaticPage::destroy($request->post_id)) {
            return [
                'ok' => true,
                'message' => 'حذف  با موفقیت انجام شد',
            ];
        }

        return [
            'ok' => false,
            'message' => 'خطا در حذف خبر!',
        ];

    }

    public function admin_deactive(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required',

        ], [], [
            'post_id' => 'عنوان',
        ]);

        $news = StaticPage::findOrFail($request->post_id);
        if($news->status == 'deactive')
            $news->status = 'active';
        else
            $news->status = 'deactive';
        if ($news->save()) {
            return [
                'ok' => true,
                'message' => 'تغییر وضعیت با موفقیت انجام شد',
            ];
        }

        return [
            'ok' => false,
            'message' => 'خطا !',
        ];

    }

    public function admin_store(Request $request)
    {
        $this->validate($request, [
            'txtTitel' => 'required',
            'desc_news' => 'required',
            'txtfull_text' => 'required',
            'txtpic' => 'required',
            'txtTag' => 'required',
        ], [], [
            'txtTitel' => 'عنوان',
            'desc_news' => 'خلاصه ی خبر',
            'txtfull_text' => 'متن خبر',
            'txtpic' => 'تصویر خبر',
            'txtTag' => 'کلمات کلیدی',
        ]);

        $tags = explode(',', $request->txtTag);
        $tags_id = [];
        foreach ($tags as $tag) {
            if (trim($tag) != '') {
                $tag_q = \App\Tag::firstOrCreate(['user_id' => $request->user()->id, 'title' => $tag]);
                $tags_id[] = $tag_q->id;
            }
        }

        $news = new StaticPage();
        $news->user_id = $request->user()->id;
        $news->title = $request->txtTitel;
        $news->descr = $request->desc_news;
        $news->full_text = $request->txtfull_text;
        $news->thumbfiles = json_decode($request->txtpic, true);#'{\"0\":{\"caption\":\"test caption\",\"file\":\"/../files/slider3.png\"}}';#$request->txtpic;
        $news->tags = $tags;
        $news->status = 'accept';
        $news->timestp = time();
        $news->visit = 0;

        if ($news->save()) {

            $tags = explode(',', $request->txtTag);
            foreach ($tags as $tag) {
                if (trim($tag) != '') {
                    $tag_q = \App\Tag::firstOrCreate(['user_id' => $request->user()->id, 'title' => $tag]);
                    $tag_post = \App\TagModulePost::firstOrCreate(['module_name' => 'staticpage', 'tag_id' => $tag_q->id, 'post_id' => $news->id]);
                }
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'summary' => 'required',
            'text' => 'required',
            'file_pic' => 'required',
            'lang' => 'required',
        ], [], [
            'title' => 'عنوان',
            'summary' => 'خلاصه مطلب',
            'text' => 'متن',
            'file_pic' => 'تصویر مطلب',
            'lang' => 'زبان',
        ]);

        $tags =  $request->tags;
        $tags_id = [];
        if(!empty($tags))
            foreach ($tags as $tag) {
                if (trim($tag) != '') {
                    $tag_q = Tag::firstOrCreate(['user_id' => $request->user()->id, 'title' => $tag]);
                    $tags_id[] = $tag_q->id;
                }
            }

        $news = new StaticPage();
        $news->lang = $request->lang;
        $news->title = $request->title;
        $news->descr = $request->summary;
        $news->full_text = $request->text;
        $news->user_id = $request->user()->id;
        $news->image_url = $request->file_pic;
        $news->status = 'active';
        $news->show_part = $request->show_part;
        $news->visit = 0 ;
        $news->cats = isset($request->sub_cat)?$request->sub_cat : 0 ;
        $news->tags = implode(',', $tags_id );

        if ($news->save()) {

            return [
                'ok' => true,
                'message' => 'مطلب جدید به درستی ثبت گردید',
            ];

        }

        return [
            'ok' => false,
            'message' => 'ثبت با مشکل رو برو شد!',
        ];

    }

}
