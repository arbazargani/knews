<?php

namespace App\Http\Controllers\Course;

use App\Course;
use App\CourseCat;
use App\ModuleCat;
use App\UserPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function cat_list()
    {
        return view(\App::getLocale() . '.course.cat_list');
    }

    public function cat_list_post(Request $request)
    {
        $ModuleCat = ModuleCat::where('module', 'course')->where('lang', \App::getLocale());

        $total = $ModuleCat->count();
        $sort = $request->has('sort') ? $request->input('sort') : 'created_at';
        $order = $request->has('order') ? $request->input('order') : 'desc';
        $sorts = explode(',', $sort);
        $orders = explode(',', $order);
        foreach ($sorts as $key => $value) {
            $ModuleCat->orderBy($value, $orders[$key]);
        }

        $page = $request->has('page') ? $request->input('page') : 1;
        $rows = $request->has('rows') ? $request->input('rows') : 10;
        $offset = ($page - 1) * $rows;


        return [
            'total' => $total,
            'rows' => $ModuleCat->skip($offset)->take($rows)->get(['id', 'title as ctitle', 'updated_at']),
        ];
    }

    public function course_list($cat_id = 0)
    {
        return view(\App::getLocale() . '.course.course_list', compact('cat_id'));
    }

    public function course_list_post(Request $request)
    {
        $courses = Course::where('status', 'active')->where('lang', \App::getLocale());
        if ($request->cat_id != 0) {
            $courses_cat = CourseCat::where('cat_id', $request->cat_id)->get(['course_id'])->toArray();
            $courses_cat = (array_flatten($courses_cat));
            $courses = $courses->whereIn('id', $courses_cat);
        }

        $total = $courses->count();

        $sort = $request->has('sort') ? $request->input('sort') : 'created_at';
        $order = $request->has('order') ? $request->input('order') : 'desc';
        $sorts = explode(',', $sort);
        $orders = explode(',', $order);
        foreach ($sorts as $key => $value) {
            $courses->orderBy($value, $orders[$key]);
        }

        $page = $request->has('page') ? $request->input('page') : 1;
        $rows = $request->has('rows') ? $request->input('rows') : 10;
        $offset = ($page - 1) * $rows;


        return [
            'total' => $total,
            'rows' => $courses->skip($offset)->take($rows)->get(['id', 'title as ctitle', 'price as cprice', 'updated_at']),
        ];
    }

    public function show(Request $request)
    {
        $course = Course::where('status', 'active')->findOrFail($request->id);
        if ($course->price != 0) {
            $user_peyment = UserPayment::where('course_id', $request->id)
                ->where('user_id', \Auth::user()->id)
                ->where('status', 'payment')
                ->first();
            if(count($user_peyment) == 0){
                return redirect(route('peyment.course',[ $request->id ]));
            }
        }
        $course->visit = $course->visit + 1 ;
        $course->save();
        return view(\App::getLocale().'.course.course_show',compact('course'));
    }
}
