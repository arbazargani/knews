<?php

namespace App\Http\Controllers\Course\Admin;

use App\Course;
use App\CourseCat;
use App\ModuleCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function create()
    {
        $moduleCat = ModuleCat::where('module', 'course')->orderBy('id', 'desc')->get();
        return view('course.admin.create', compact('moduleCat'));
    }

    public function index()
    {
        return view('course.admin.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            #'descr' => 'required',
            'text' => 'required',
            'type' => 'required',
//            'published_at' => 'required',
            'img' => 'required',
            'prices' => 'required',
        ], [], [
            'title' => 'عنوان مطلب',
            #'descr' => 'خلاصه ',
            'text' => 'متن ',
            'type' => ' دسته بندی',
//            'published_at' => 'تاریخ انتشار',
            'img' => 'تصویر',
            'prices' => 'قیمت',
        ]);

        $a = Course::orderBy('show_order', 'desc')->first();
        if (empty($a))
            $count = 0;
        else
            $count = $a->show_order + 1;
        $articaleCat = $request->type;

        $articale = new Course();
        $articale->title = $request->title;
        $articale->descr = $request->descr;
        $articale->fulltext = $request->text;
        $articale->imgs = $request->img;
        $articale->files = $request->filesUrl;
        $articale->video = $request->videoUrl;
        $articale->audio = $request->audioUrl;

        $articale->lang = $request->lang;
        $articale->price = $request->prices;

        $articale->show_order = $count;
        $articale->user_id = $request->user()->id;
        $articale->cats = implode(',', $articaleCat);
        $articale->save();

        foreach ($articaleCat as $cat_to) {

            $ArticleCat = new CourseCat();
            $ArticleCat->course_id = $articale->id;
            $ArticleCat->cat_id = $cat_to;
            $ArticleCat->save();

        }

        return ['ok' => true];
    }

    public function items(Request $request)
    {
        $polls = Course::select('id', 'title', 'visit', 'show_order')#->where('user_id', \Auth::user()->id)
        ;

        if ($request->has('filterRules')) {
            $filters = json_decode($request->get('filterRules'), true);
            foreach ($filters as $filter) {
                if ($filter['field'] == 'title')
                    $polls->where($filter['field'], 'LIKE', "%{$filter['value']}%");
            }
        }

        $count = $polls->count();
        $sort = $request->has('sort') ? $request->input('sort') : 'created_at';
        $order = $request->has('order') ? $request->input('order') : 'desc';
        $sorts = explode(',', $sort);
        $orders = explode(',', $order);
        foreach ($sorts as $key => $value) {
            $polls->orderBy($value, $orders[$key]);
        }

        $page = $request->has('page') ? $request->input('page') : 1;
        $rows = $request->has('rows') ? $request->input('rows') : 10;
        $offset = ($page - 1) * $rows;

        return [
            'total' => $count,
            'rows' => $polls->skip($offset)->take($rows)->get(),
        ];
    }

    public function edit(Request $request, $edit_id)
    {
        $course = Course::findOrFail($edit_id);
        $moduleCat = ModuleCat::where('module', 'course')->orderBy('id', 'desc')->get();
        return view('course.admin.edit', compact('course', 'moduleCat'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'edit_id' => 'required',
            'title' => 'required',
            #'descr' => 'required',
            'text' => 'required',
            'type' => 'required',
//            'published_at' => 'required',
            'img' => 'required',
            'prices' => 'required',
        ], [], [
            'edit_id' => 'عنوان مطلب',
            'title' => 'عنوان مطلب',
            #'descr' => 'خلاصه ',
            'text' => 'متن ',
            'type' => ' دسته بندی',
//            'published_at' => 'تاریخ انتشار',
            'img' => 'تصویر',
            'prices' => 'فیمت',
        ]);

        $articaleCat = $request->type;

        $articale = Course::findOrFail($request->edit_id);
        $articale->title = $request->title;
        $articale->descr = $request->descr;
        $articale->fulltext = $request->text;
        $articale->imgs = $request->img;
        $articale->files = $request->filesUrl;
        $articale->video = $request->videoUrl;
        $articale->audio = $request->audioUrl;
        $articale->show_order = $request->show_order;

        $articale->lang = $request->lang;
        $articale->price = $request->prices;

        $articale->user_id = $request->user()->id;
        $articale->cats = implode(',', $articaleCat);
        $articale->save();

        $articleCat = CourseCat::where('course_id', $request->edit_id)->delete();

        foreach ($articaleCat as $cat_to) {

            $ArticleCat = new CourseCat();
            $ArticleCat->course_id = $articale->id;
            $ArticleCat->cat_id = $cat_to;
            $ArticleCat->save();

        }

        return ['ok' => true];
    }

    public function delete(Request $request)
    {
        $poll = CourseCat::where('course_id', $request->id)->delete();
        $poll = Course::where('id', $request->id)/*->where('user_id',\Auth::user()->id)*/
        ->delete();
        return [
            'ok' => true
        ];
    }

}
