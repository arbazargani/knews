<?php

namespace App\Http\Controllers\Peyment;

use App\Course;
use App\Product;
use App\UserPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeymentContoller extends Controller
{
    public function course(Request $request)
    {
        $course = Course::where('status', 'active')->findOrFail($request->id);
        if ($course->price != 0) {
            $user_peyment = UserPayment::where('course_id', $request->id)
                ->where('module', 'course')
                ->where('user_id', \Auth::user()->id)
                ->where('status', 'payment')
                ->first();
            if (count($user_peyment) == 0) {
                return view(\App::getLocale() . '.peyment.factor' ,compact('course') );
            }
            return redirect(route('course.show', [$request->id]));
        }
        return redirect(route('course.show', [$request->id]));
    }

    public function course_post(Request $request)
    {
        // درگاه
    }

    public function product(Request $request)
    {
        $course = Product::where('status', 'active')->findOrFail($request->id);
        if ($course->price != 0) {
            $user_peyment = UserPayment::where('course_id', $request->id)
                ->where('module', 'product')
                ->where('user_id', \Auth::user()->id)
                ->where('status', 'payment')
                ->first();
            if (count($user_peyment) == 0) {
                return view(\App::getLocale() . '.peyment.factor' ,compact('course') );
            }
            return redirect(route('products.show', [$request->id , '1']));
        }
        return redirect(route('products.show', [$request->id , '1']));
    }

    public function product_post(Request $request)
    {
        // درگاه
    }
}
