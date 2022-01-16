<?php

namespace App\Libraries;

use App\Product;
use App\ProductCat;

class ProductCatFront
{
    public function fetch()
    {
        return ProductCat::where('status', 'active')->where('lang', \App::getLocale())->where('parent_id', 0)->orderBy('show_order', 'Desc')->get();
    }

    public function fetchAll()
    {
        return ProductCat::where('status', 'active')->where('lang', \App::getLocale())->orderBy('show_order', 'Desc')->get();
    }

    public function fetch_rand($count = 7)
    {
        $pc = ProductCat::where('status', 'active')->where('lang', \App::getLocale())->where('parent_id', '!=', 0)->inRandomOrder()->first(['id', 'title']);
        $pcc = $pc->children;
        if (count($pcc) > 0) {
            $pro_cat = $pcc[0] ;
            $p = Product::where('status', 'active')->where('lang', \App::getLocale())->where('cat_id', $pcc[0]->id)->inRandomOrder()->take($count)->get();
        } else{
            $pro_cat = $pc ;
            $p = Product::where('status', 'active')->where('lang', \App::getLocale())->where('cat_id', $pc->id)->inRandomOrder()->take($count)->get();
        }

        return [
            'cat' => $pro_cat ,
            'pcat' => $p
        ];
    }


}