<?php

namespace App\Http\Controllers\SubScriptions\Admin;

use App\SubScription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubScriptionsController extends Controller
{
    public function index()
    {
        return view('sub_scriptions._admin.index_all');
    }

    public function create()
    {
        return view('sub_scriptions._admin.create');
    }

    public function edit($id)
    {
        $news = SubScription::findOrFail($id);
        return view('sub_scriptions._admin.edit', compact('news'));
    }

    public function _list(Request $request)
    {
        #$query = News::select('_id', 'title as txtTitle', 'created_at as c_at', 'visit', 'status')->where('user_id', '=', $request->user()->id);
        $query = SubScription::where('user_id', '=', $request->user()->id);
        $total = $query->count();
        return [
            'total' => $total,
            'rows' => $query->get(['id', 'title', 'created_at', 'count_product','duration_membership', 'base_price', 'status']),
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'advertising' => 'required',
            'base_price' => 'required|integer',
            'count_product' => 'required|integer',
            'duration_membership' => 'required',
            'message' => 'required',
            'price_product_addition' => 'required|integer',
            'special_page' => 'required',
            'special_page_slider' => 'required',
            'lang' => 'required',
        ], [], [
            'title' => 'عنوان',
            'advertising' => 'آگهی های ویژه',
            'base_price' => 'قیمت پایه سرویس (ریال)',
            'count_product' => 'تعداد محصولات',
            'duration_membership' => 'مدت عضویت / ماه',
            'message' => 'صندوق پیام اختصاصی',
            'price_product_addition' => ' قیمت هر محصول اضافه (ریال)',
            'special_page' => 'صفحه مخصوص شرکت',
            'special_page_slider' => 'بَنر ( slider ) انحصاری',
            'lang' => 'زبان',
        ]);

        $subs = new SubScription();
        $subs->lang = implode(',', $request->lang);
        $subs->title = $request->title;
        $subs->count_product = $request->count_product;
        $subs->special_page = $request->special_page;
        $subs->special_page_slider = $request->special_page_slider;
        $subs->advertising = $request->advertising;
        $subs->message = $request->message;
        $subs->duration_membership = $request->duration_membership;
        $subs->base_price = $request->base_price;
        $subs->user_id = $request->user()->id;
        $subs->price_product_addition = $request->price_product_addition;
        $subs->status = 'active';

        if ($subs->save()) {

            return [
                'ok' => true,
                'message' => 'سرویس جدید به درستی ثبت گردید',
            ];

        }

        return [
            'ok' => false,
            'message' => 'ثبت با مشکل رو برو شد!',
        ];

    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'advertising' => 'required',
            'base_price' => 'required|integer',
            'count_product' => 'required|integer',
            'duration_membership' => 'required',
            'message' => 'required',
            'price_product_addition' => 'required|integer',
            'special_page' => 'required',
            'special_page_slider' => 'required',
            'lang' => 'required',
        ], [], [
            'title' => 'عنوان',
            'advertising' => 'آگهی های ویژه',
            'base_price' => 'قیمت پایه سرویس (ریال)',
            'count_product' => 'تعداد محصولات',
            'duration_membership' => 'مدت عضویت / ماه',
            'message' => 'صندوق پیام اختصاصی',
            'price_product_addition' => ' قیمت هر محصول اضافه (ریال)',
            'special_page' => 'صفحه مخصوص شرکت',
            'special_page_slider' => 'بَنر ( slider ) انحصاری',
            'lang' => 'زبان',
        ]);

        $subs = SubScription::find($request->edit_id);
        $subs->lang = implode(',', $request->lang);
        $subs->title = $request->title;
        $subs->count_product = $request->count_product;
        $subs->special_page = $request->special_page;
        $subs->special_page_slider = $request->special_page_slider;
        $subs->advertising = $request->advertising;
        $subs->message = $request->message;
        $subs->duration_membership = $request->duration_membership;
        $subs->base_price = $request->base_price;
        $subs->user_id = $request->user()->id;
        $subs->price_product_addition = $request->price_product_addition;
        $subs->status = 'active';

        if ($subs->save()) {

            return [
                'ok' => true,
                'message' => 'سرویس جدید به درستی ثبت گردید',
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

        if (SubScription::destroy($request->post_id)) {
            return [
                'ok' => true,
                'message' => 'حذف خبر با موفقیت انجام شد',
            ];
        }

        return [
            'ok' => false,
            'message' => 'خطا در حذف !',
        ];

    }

    public function deactive(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required',

        ], [], [
            'post_id' => 'عنوان',
        ]);

        $news = SubScription::findOrFail($request->post_id);
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


}
