<?php

namespace App\Http\Controllers\Product;

use App\Course;
use App\CourseCat;
use App\ModuleCat;
use App\Product;
use App\UserPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $rows = $request->input('rows', 9);
        $query = Product::where('status', 'active')->where('lang', \App::getLocale());
        $products = $query->paginate($rows);
        return view(\App::getLocale() . '.product.products_list',compact('products'));
    }

    public function cat_list()
    {
        return view(\App::getLocale() . '.product.cat_list');
    }

    public function cat_list_post(Request $request)
    {
        $ModuleCat = ModuleCat::where('module', 'product')->where('lang', \App::getLocale());

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

    public function product_list($cat_id = 0)
    {
        return view(\App::getLocale() . '.product.product_list', compact('cat_id'));
    }

    public function product_list_post(Request $request)
    {
        $products = Course::where('status', 'active')->where('lang', \App::getLocale());
        if ($request->cat_id != 0) {
            $products_cat = productCat::where('cat_id', $request->cat_id)->get(['product_id'])->toArray();
            $products_cat = (array_flatten($products_cat));
            $products = $products->whereIn('id', $products_cat);
        }

        $total = $products->count();

        $sort = $request->has('sort') ? $request->input('sort') : 'created_at';
        $order = $request->has('order') ? $request->input('order') : 'desc';
        $sorts = explode(',', $sort);
        $orders = explode(',', $order);
        foreach ($sorts as $key => $value) {
            $products->orderBy($value, $orders[$key]);
        }

        $page = $request->has('page') ? $request->input('page') : 1;
        $rows = $request->has('rows') ? $request->input('rows') : 10;
        $offset = ($page - 1) * $rows;


        return [
            'total' => $total,
            'rows' => $products->skip($offset)->take($rows)->get(['id', 'title as ctitle', 'price as cprice', 'updated_at']),
        ];
    }

    public function show(Request $request)
    {
        $product = Product::where('status', 'active')->findOrFail($request->id);
        $product->visit = $product->visit + 1;
        $product->save();
        return view(\App::getLocale() . '.product.product_show', compact('product'));
    }
}
