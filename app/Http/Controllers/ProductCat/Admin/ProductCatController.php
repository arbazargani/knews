<?php

namespace App\Http\Controllers\ProductCat\Admin;

use App\Http\Requests;
use App\ProductCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductCatController extends Controller
{
    public function cat_create($module_name)
    {
        $cats = ProductCat::where('module',$module_name)->get();
        return view('product_cat._admin.create', compact('cats','module_name'));
    }

    public function cat_store(Request $request,$module_name)
    {
        $this->validate($request, [
            'txtTitel' => 'required',
            'file_pic' => 'required',
            'lang' => 'required',
            'sub_cat' => 'required',
        ], [], [
            'txtTitel' => 'عنوان',
            'file_pic' => 'تصویر',
            'lang' => 'زبان',
            'sub_cat' => 'زیر منو',
        ]);

        $news_cat = new ProductCat();
        $news_cat->title = $request->txtTitel;
        $news_cat->user_id = $request->user()->id;
        $news_cat->lang = $request->lang ;
        $news_cat->parent_id = $request->sub_cat;
        $news_cat->image_url = $request->file_pic;
        $news_cat->module = $module_name;
        $news_cat->property = json_encode(array_filter($request->property));

        if ($news_cat->save()) {
            return [
                'ok' => true,
                'message' => 'دسته بندی جدید به درستی ثبت گردید',
            ];
        }

        return [
            'ok' => false,
            'message' => 'ثبت با مشکل رو برو شد!',
        ];

    }

    public function cat_index($module_name)
    {
        return view('product_cat._admin.index' , compact('module_name'));
    }

    public function cat_list(Request $request ,$module_name )
    {
        $query = ProductCat::where('user_id', $request->user()->id)->where('module',$module_name);
        $total = $query->count();
        return [
            'total' => $total,
            'rows' => $query->get(['id', 'title', 'created_at']),
        ];
    }

    public function cat_edit($id,$module_name,Request $request)
    {
        $cats = ProductCat::where('user_id', $request->user()->id)->where('id','!=',$id)->get();
        $news_cat = ProductCat::where('id' , $id)->where('user_id', $request->user()->id)->firstOrFail();
//        dd(json_decode($news_cat->property,true));
        return view('product_cat._admin.edit',compact('news_cat','cats','module_name'));
    }

    public function cat_update(Request $request ,$module_name)
    {
        $this->validate($request, [
            'edit_id' => 'required',
            'txtTitel' => 'required',
            'file_pic' => 'required',
            'lang' => 'required',
            'sub_cat' => 'required',
        ], [], [
            'edit_id' => 'عنوان',
            'txtTitel' => 'عنوان',
            'file_pic' => 'خلاصه ی خبر',
            'lang' => 'زبان',
            'sub_cat' => 'زیر منو',
        ]);

        $news_cat = ProductCat::where('id' , $request->edit_id)->where('user_id', $request->user()->id)->firstOrFail();
        $news_cat->title = $request->txtTitel;
        $news_cat->user_id = $request->user()->id;
        $news_cat->lang = $request->lang;
        $news_cat->parent_id = $request->sub_cat;
        $news_cat->image_url = $request->file_pic;
        $news_cat->module = $module_name;
        $news_cat->property = json_encode(array_filter($request->property));

        if ($news_cat->save()) {
            return [
                'ok' => true,
                'message' => 'دسته بندی به درستی ویرایش گردید',
            ];
        }

        return [
            'ok' => false,
            'message' => 'ثبت با مشکل رو برو شد!',
        ];
    }

    public function cat_edit_status(Request $request)
    {
        $news_cat = ProductCat::where('id' , $request->id)->where('user_id', $request->user()->id)->firstOrFail();
        if($news_cat->status == 'active')
            $news_cat->status = 'deactive';
        else
            $news_cat->status = 'active';

        if ($news_cat->save()) {
            return [
                'ok' => true,
                'message' => 'دسته بندی به درستی ویرایش گردید',
            ];
        }

        return [
            'ok' => false,
            'message' => 'ثبت با مشکل رو برو شد!',
        ];

    }

    public function cat_remove(Request $request)
    {
        $news_cat = ProductCat::where('id' , $request->id)->where('user_id', $request->user()->id)->delete();
        return [
            'ok' => true,
            'message' => 'حذف به درستی انجام گردید',
        ];
    }
}
