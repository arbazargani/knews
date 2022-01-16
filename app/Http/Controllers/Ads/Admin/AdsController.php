<?php

namespace App\Http\Controllers\Ads\Admin;

use App\Ads;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdsController extends Controller
{
    public function index()
    {
        return view('ads._admin.index');
    }

    public function create()
    {
        return view('ads._admin.create');
    }

    public function edit($id)
    {
        $ads = Ads::findOrFail($id);
        return view('ads._admin.edit', compact('ads'));
    }

    public function _list(Request $request)
    {
        $query = Ads::where('user_id', $request->user()->id);

        if ($request->has('filterRules')) {
            $filters = json_decode($request->get('filterRules'), true);
            foreach ($filters as $filter) {
                if ($filter['field'] == 'title')
                    $query->where($filter['field'], 'LIKE', "%{$filter['value']}%");
                elseif ($filter['field'] == 'status') {
                    $query->where($filter['field'], $filter['value']);
                } elseif ($filter['field'] == 'ads_type') {
                    $query->where($filter['field'], $filter['value']);
                } elseif ($filter['field'] == 'slider') {
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
        return [
            'total' => $total,
            'rows' => $query->get(['_id', 'title', 'created_at', 'visit', 'status']),
        ];
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'edit_id' => 'required',
            'title' => 'required',
            'file_pic' => 'required',
            'lang' => 'required',
            'status' => 'required',
            'link' => 'required',
            'location' => 'required',
        ], [], [
            'edit_id' => 'عنوان',
            'title' => 'عنوان',
            'file_pic' => 'خلاصه ی تبلیغ',
            'lang' => 'زبان',
            'status' => 'وضعیت',
            'link' => 'لینک',
            'location' => 'جایگاه',
        ]);

        $ads = Ads::find($request->edit_id);
        $ads->lang = $request->lang;
        $ads->title = $request->title;
        $ads->user_id = $request->user()->id;
        $ads->status = $request->status;
        $ads->link = $request->link;
        $ads->location = $request->location;
        $ads->image_url = $request->file_pic;
        $ads->created_at = Carbon::now()->toDateTimeString();//\jDateTime::createDateTimeFromFormat('Y/m/d h:i:s', convertPersiantoEnglishDigits($request->date)) ;
        $ads->publish_at = Carbon::now()->toDateTimeString();//\jDateTime::createDateTimeFromFormat('Y/m/d h:i:s', convertPersiantoEnglishDigits($request->date)) ;
        $ads->expired_at = Carbon::now()->toDateTimeString();//\jDateTime::createDateTimeFromFormat('Y/m/d h:i:s', convertPersiantoEnglishDigits($request->date)) ;

        if ($ads->save()) {

            return [
                'ok' => true,
                'message' => 'تبلیغ  به درستی ویرایش گردید',
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

        if (Ads::destroy($request->post_id)) {
            return [
                'ok' => true,
                'message' => 'حذف تبلیغ با موفقیت انجام شد',
            ];
        }

        return [
            'ok' => false,
            'message' => 'خطا در حذف تبلیغ!',
        ];

    }

    public function deactive(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required',

        ], [], [
            'post_id' => 'عنوان',
        ]);

        $ads = Ads::findOrFail($request->post_id);
        if ($ads->status == 'deactive')
            $ads->status = 'active';
        else
            $ads->status = 'deactive';

        if ($ads->save()) {
            return [
                'ok' => true,
                'message' => 'تغییر وضعیت تبلیغ با موفقیت انجام شد',
            ];
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
            'file_pic' => 'required',
            'lang' => 'required',
            'status' => 'required',
            'link' => 'required',
            'location' => 'required',
        ], [], [
            'title' => 'عنوان',
            'file_pic' => 'تصویر',
            'lang' => 'زبان',
            'status' => 'وضعیت',
            'link' => 'لینک',
            'location' => 'جایگاه',
        ]);

        $ads = new Ads();
        $ads->lang = $request->lang;
        $ads->title = $request->title;
        $ads->user_id = $request->user()->id;
        $ads->status = $request->status;
        $ads->link = $request->link;
        $ads->image_url = $request->file_pic;
        $ads->location = $request->location;
        $ads->visit = 0;
        $ads->created_at = Carbon::now()->toDateTimeString();//\jDateTime::createDateTimeFromFormat('Y/m/d h:i:s', convertPersiantoEnglishDigits($request->date)) ;
        $ads->publish_at = Carbon::now()->toDateTimeString();//\jDateTime::createDateTimeFromFormat('Y/m/d h:i:s', convertPersiantoEnglishDigits($request->date)) ;
        $ads->expired_at = Carbon::now()->toDateTimeString();//\jDateTime::createDateTimeFromFormat('Y/m/d h:i:s', convertPersiantoEnglishDigits($request->date)) ;

        if ($ads->save()) {

            return [
                'ok' => true,
                'message' => 'تبلیغ جدید به درستی ثبت گردید',
            ];
        }

        return [
            'ok' => false,
            'message' => 'ثبت با مشکل رو برو شد!',
        ];

    }

}
