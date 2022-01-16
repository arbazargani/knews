<?php

namespace App\Http\Controllers\Product\Admin;

use App\ModuleCat;
use App\Product;
use App\ProductCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function create()
    {
        $moduleCat = ModuleCat::where('module', 'products')->orderBy('id', 'desc')->get();
        return view('product.admin.create', compact('moduleCat'));
    }

    public function index()
    {
        return view('product.admin.index');
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

        $a = Product::orderBy('show_order', 'desc')->first();
        if (empty($a))
            $count = 0;
        else
            $count = $a->show_order + 1;
        $articaleCat = $request->type;

        $articale = new Product();
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

            $ArticleCat = new ProductCat();
            $ArticleCat->product_id = $articale->id;
            $ArticleCat->cat_id = $cat_to;
            $ArticleCat->save();

        }

        return ['ok' => true];
    }

    public function items(Request $request)
    {
        $polls = Product::select('id', 'title', 'visit','price', 'show_order')#->where('user_id', \Auth::user()->id)
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
        $product = Product::findOrFail($edit_id);
        $moduleCat = ModuleCat::where('module', 'products')->orderBy('id', 'desc')->get();
        return view('product.admin.edit', compact('product', 'moduleCat'));
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

        $articale = Product::findOrFail($request->edit_id);
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

        $articleCat = ProductCat::where('product_id', $request->edit_id)->delete();

        foreach ($articaleCat as $cat_to) {

            $ArticleCat = new ProductCat();
            $ArticleCat->product_id = $articale->id;
            $ArticleCat->cat_id = $cat_to;
            $ArticleCat->save();

        }

        return ['ok' => true];
    }

    public function delete(Request $request)
    {
//        $poll = CourseCat::where('product_id', $request->id)->delete();
        $poll = Product::where('id', $request->id)/*->where('user_id',\Auth::user()->id)*/
        ->delete();
        return [
            'ok' => true
        ];
    }

}
