<?php

namespace App\Http\Controllers\Profile;

use App\Product;
use App\ProductCat;
use App\ProductRate;
use App\User;
use App\UserCompany;
use Form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;

class ProfileController extends Controller
{
    public function index()
    {
        return view(\App::getLocale() . '.profile.dashboard');
    }

    public function change_pass(Request $request)
    {
        $this->validate($request, [
            'pass' => 'required|min:1',
        ], [], [
            'pass' => trans('auth.password'),
        ]);

        if ($request->pass != $request->confirm) {
            return response()->json([
                'password' => [trans('custom.pass_not_valid')]
            ], 422);
        }

        $usr = \App\User::findOrFail(\Auth::user()->id);
        $usr->password = bcrypt($request->pass);
        $usr->save();

        return response()->json([
            'ok' => true,
            'msg' => [trans('custom.pass_changed')]
        ], 200);
    }

    public function personal()
    {
        return view(\App::getLocale() . '.profile.personal_information');
    }

    public function company_list()
    {
        return view(\App::getLocale() . '.profile.company_list');
    }

    public function company_list_post()
    {
        $user_companies = \Auth::user()->companies();
        $total = $user_companies->count();
        return [
            'total' => $total,
            'rows' => $user_companies->get(['id', 'company_name as title', 'created_at']),
        ];

    }

    public function personal_update(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required',
            'file_url' => 'required',
        ], [], [
            'firstname' => trans('auth.name'),
            'lastname' => trans('auth.family'),
            'mobile' => trans('auth.mobile'),
            'file_url' => trans('custom.avatar'),
        ]);

        $user_new = User::find(\Auth::user()->id);
        $user_new->name = $request->firstname;
        $user_new->family = $request->lastname;
        $user_new->mobile = $request->mobile;
        $user_new->avatar = $request->file_url;
        $user_new->save();
        return redirect(route('profile.index'));
    }

    public function company_edit($id)
    {
        $user_companies = \Auth::user()->companies()->where('id', $id)->get();
        return view(\App::getLocale() . '.profile.company_information', compact('user_companies'));
    }

    public function company_slider()
    {
        $user_companies = \Auth::user()->companies()->get(['id', 'company_name']);
        $comp[0] = trans('custom.choose');
        foreach ($user_companies as $val) {
            $comp[$val->id] = $val->company_name;
        }
        return view(\App::getLocale() . '.profile.slider', compact('comp'));
    }

    public function company_slider_img(Request $request)
    {
        $user_companies = \Auth::user()->companies()->where('id', $request->cid)->first(['slider']);
        return [
            'ok' => true,
            'data' => $user_companies->toArray()
        ];
    }

    public function company_slider_img_store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|not_in:0',
            'file_url' => 'required',
        ], [], [
            'company_name' => trans('custom.company_name'),
            'file_url' => trans('custom.avatar'),
        ]);
        $uc = UserCompany::where('id', $request->company_name)->firstOrFail();
        $uc->slider = $request->file_url;
        $uc->save();
        return [
            'ok' => true,
            'link' => route('profile.index')
        ];
    }


    public function company_edit_post(Request $request)
    {
        $this->validate($request, [
            'company' => 'required',
            'brand' => 'required',
            'country_id' => 'required',
            'zone' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'tel' => 'required',
        ], [], [
            'company' => trans('auth.company'),
            'brand' => trans('custom.brand'),
            'country_id' => trans('auth.country'),
            'zone' => trans('auth.zone'),
            'city' => trans('auth.city'),
            'postcode' => trans('auth.postcode'),
            'tel' => trans('auth.tel'),
        ]);

        $ucompany = UserCompany::where('user_id', \Auth::user()->id)->where('id', $request->id)->firstOrFail();
        $ucompany->company_name = $request->company;
        $ucompany->brand = $request->brand;
        $ucompany->company_addr = $request->address;
        $ucompany->country_id = $request->country_id;
        $ucompany->zone_id = $request->zone;
        $ucompany->city = $request->city;
        $ucompany->postcode = $request->postcode;
        $ucompany->tel = $request->tel;
        $ucompany->fax = $request->fax;
        $ucompany->save();
        return redirect(route('profile.index'));
    }

    public function product_create()
    {
        $plan = \Auth::user()->plan()->where('status', 'active')->first();
        if (is_null($plan))
            return redirect(route('sub_scriptions.index'));

        $comps = \Auth::user()->companies()->get(['id', 'brand']);
        $companies = [];
        foreach ($comps as $val)
            $companies[$val->id] = $val->brand;

        $p_cats = ProductCat::where('parent_id', 0)->where('status', 'active')->where('lang', \App::getLocale())->get();
        $product_cats = [];
        foreach ($p_cats as $pc) {
            $product_cats [$pc->id] = $pc->title;
        }

        return view(\App::getLocale() . '.profile.product.create', compact('product_cats', 'companies'));
    }

    public function product_cat_list(Request $request)
    {
        $p_cats = ProductCat::where('parent_id', $request->cat_id)->where('status', 'active')->where('lang', \App::getLocale())->get();
        $product_cats = [];
        foreach ($p_cats as $pc) {
            $product_cats [$pc->id] = $pc->title;
        }
        return [
            'ok' => true,
            'data' => $product_cats
        ];
    }

    public function product_create_post(Request $request)
    {
        $this->validate($request, [
            'select_cat' => 'required|exists:product_cats,id',
            'brand' => 'required|exists:user_companies,id',
            'product_name' => 'required',
            'product_model' => 'required',
            'file_url' => 'required',
            'minimum_order' => 'required|integer',
        ], [], [
            'select_cat' => trans('custom.category'),
            'brand' => trans('custom.brand'),
            'product_name' => trans('custom.product_name'),
            'product_model' => trans('custom.product_model'),
            'file_url' => trans('custom.product_images'),
            'minimum_order' => trans('custom.minimum_order'),
        ]);
        $this->validate($request, [
            'minimum_order_unit' => 'required|not_in:0|integer',
            'supply_ability' => 'required',
            'supply_ability_unit' => 'required|not_in:0|integer',
            'supply_ability_per' => 'required|not_in:0|integer',
            'prices' => 'required',
            'prices_currency' => 'required|not_in:0|integer',
            'prices_unit' => 'required|not_in:0|integer',
        ], [], [
            'minimum_order_unit' => trans('custom.amount'),
            'supply_ability' => trans('custom.supply_ability'),
            'supply_ability_unit' => trans('custom.supply_ability'),
            'supply_ability_per' => trans('custom.supply_ability'),
            'prices' => trans('custom.prices'),
            'prices_currency' => trans('custom.prices'),
            'prices_unit' => trans('custom.prices'),
        ]);
        $this->validate($request, [
            'delivery_time' => 'required',
            'delivery_terms' => 'required|not_in:0',
            'payments_terms' => 'required|not_in:0',
            'product_keyword' => 'required',
            'packing_details' => 'required',
            'description_detailed' => 'required',
            'lang' => 'required',
            'agree' => 'required',
        ], [], [
            'delivery_time' => trans('custom.delivery_time'),
            'delivery_terms' => trans('custom.delivery_terms'),
            'payments_terms' => trans('custom.payments_terms'),
            'product_keyword' => trans('custom.product_keyword'),
            'packing_details' => trans('custom.packing_details'),
            'description_detailed' => trans('custom.description_detailed'),
            'lang' => trans('custom.lang'),
            'agree' => trans('custom.rule_agree'),
        ]);

        $product = new Product;
        $product->user_id = $request->user()->id;
        $product->cat_id = $request->select_cat;
        $product->product_name = $request->product_name;
        $product->product_model = $request->product_model;
        $product->file_url = $request->file_url;
        $product->minimum_order = $request->minimum_order;
        $product->minimum_order_unit = $request->minimum_order_unit;
        $product->supply_ability = $request->supply_ability;
        $product->supply_ability_unit = $request->supply_ability_unit;
        $product->supply_ability_per = $request->supply_ability_per;
        $product->prices = $request->prices;
        $product->prices_currency = $request->prices_currency;
        $product->prices_unit = $request->prices_unit;
        $product->delivery_time = $request->delivery_time;
        $product->delivery_terms = implode(',', $request->delivery_terms);
        $product->payments_terms = implode(',', $request->payments_terms);
        $product->product_keyword = implode(',', $request->product_keyword);
        $product->packing_details = $request->packing_details;
        $product->description_detailed = $request->description_detailed;
        $product->lang = $request->lang;
        $product->status = 'deactive';

        if ($product->save()) {
            return [
                'ok' => true,
                'msg' => trans('custom.correct_insert'),
                'link' => (\Auth::user()->isadmin == 'no') ? route('profile.products.list') : route('admin.products.list')
            ];
        } else
            return [
                'ok' => false,
                'msg' => trans('custom.incorrect_insert')
            ];
    }

    public function product_rating(Request $request)
    {
        $p = Product::findOrFail($request->pid);

        $pruser = ProductRate::where('user_id', \Auth::user()->id)->where('product_id', $request->pid);

        if ($pruser->count() == 0) {

            $pru = new ProductRate();
            $pru->user_id = \Auth::user()->id;
            $pru->product_id = $request->pid;
            $pru->star_rating = $request->data;
            $pru->save();

        } else {

            $pruser = $pruser->first();
            $pruser->star_rating = $request->data;
            $pruser->save();

        }

        $pr = ProductRate::where('product_id', $request->pid)->get(['star_rating']);
        $rate = array_flatten($pr->toArray());
        $average = array_sum($rate) / count($rate);

        $p->star_rating = $average;
        $p->save();
//        dd($prate);
    }

    public function product_edit_post(Request $request)
    {
        $this->validate($request, [
            'select_cat' => 'required|exists:product_cats,id',
            'brand' => 'required|exists:user_companies,id',
            'product_name' => 'required',
            'product_model' => 'required',
            'file_url' => 'required',
            'minimum_order' => 'required|integer',
        ], [], [
            'select_cat' => trans('custom.category'),
            'brand' => trans('custom.brand'),
            'product_name' => trans('custom.product_name'),
            'product_model' => trans('custom.product_model'),
            'file_url' => trans('custom.product_images'),
            'minimum_order' => trans('custom.minimum_order'),
        ]);
        $this->validate($request, [
            'minimum_order_unit' => 'required|not_in:0|integer',
            'supply_ability' => 'required',
            'supply_ability_unit' => 'required|not_in:0|integer',
            'supply_ability_per' => 'required|not_in:0|integer',
            'prices' => 'required',
            'prices_currency' => 'required|not_in:0|integer',
            'prices_unit' => 'required|not_in:0|integer',
        ], [], [
            'minimum_order_unit' => trans('custom.amount'),
            'supply_ability' => trans('custom.supply_ability'),
            'supply_ability_unit' => trans('custom.supply_ability'),
            'supply_ability_per' => trans('custom.supply_ability'),
            'prices' => trans('custom.prices'),
            'prices_currency' => trans('custom.prices'),
            'prices_unit' => trans('custom.prices'),
        ]);
        $this->validate($request, [
            'delivery_time' => 'required',
            'delivery_terms' => 'required|not_in:0',
            'payments_terms' => 'required|not_in:0',
            'product_keyword' => 'required',
            'packing_details' => 'required',
            'description_detailed' => 'required',
            'lang' => 'required',
            'agree' => 'required',
        ], [], [
            'delivery_time' => trans('custom.delivery_time'),
            'delivery_terms' => trans('custom.delivery_terms'),
            'payments_terms' => trans('custom.payments_terms'),
            'product_keyword' => trans('custom.product_keyword'),
            'packing_details' => trans('custom.packing_details'),
            'description_detailed' => trans('custom.description_detailed'),
            'lang' => trans('custom.lang'),
            'agree' => trans('custom.rule_agree'),
        ]);

        $product = Product::where('id', $request->id)->where('user_id', $request->user()->id)->firstOrFail();
        $product->cat_id = $request->select_cat;
        $product->product_name = $request->product_name;
        $product->product_model = $request->product_model;
        $product->file_url = $request->file_url;
        $product->minimum_order = $request->minimum_order;
        $product->minimum_order_unit = $request->minimum_order_unit;
        $product->supply_ability = $request->supply_ability;
        $product->supply_ability_unit = $request->supply_ability_unit;
        $product->supply_ability_per = $request->supply_ability_per;
        $product->prices = $request->prices;
        $product->prices_currency = $request->prices_currency;
        $product->prices_unit = $request->prices_unit;
        $product->delivery_time = $request->delivery_time;
        $product->delivery_terms = implode(',', $request->delivery_terms);
        $product->payments_terms = implode(',', $request->payments_terms);
        $product->product_keyword = implode(',', $request->product_keyword);
        $product->packing_details = $request->packing_details;
        $product->description_detailed = $request->description_detailed;
        $product->lang = $request->lang;
        $product->status = 'deactive';

        if ($product->save()) {
            return [
                'ok' => true,
                'msg' => trans('custom.correct_insert'),
                'link' => route('profile.products.list')
            ];
        } else
            return [
                'ok' => false,
                'msg' => trans('custom.incorrect_insert')
            ];
    }

    public function product_list()
    {
        return view(\App::getLocale() . '.profile.product.index');
    }

    public function product_list_post(Request $request)
    {
        $prducts = Product::where('user_id', $request->user()->id);
        $total = $prducts->count();

        $sort = $request->has('sort') ? $request->input('sort') : 'created_at';
        $order = $request->has('order') ? $request->input('order') : 'desc';
        $sorts = explode(',', $sort);
        $orders = explode(',', $order);
        foreach ($sorts as $key => $value) {
            $prducts->orderBy($value, $orders[$key]);
        }

        $page = $request->has('page') ? $request->input('page') : 1;
        $rows = $request->has('rows') ? $request->input('rows') : 10;
        $offset = ($page - 1) * $rows;

        return [
            'total' => $total,
            'rows' => $prducts->skip($offset)->take($rows)->get(['id', 'product_name as title', 'prices', 'status']),
        ];
    }

    public function product_edit($id)
    {
        $product = Product::findOrFail($id);

        $comps = \Auth::user()->companies()->get(['id', 'brand']);
        $companies = [];
        foreach ($comps as $val)
            $companies[$val->id] = $val->brand;

        $p_cats = ProductCat::where('parent_id', 0)->where('status', 'active')->where('lang', \App::getLocale())->get();
        $product_cats = [];
        foreach ($p_cats as $pc) {
            $product_cats [$pc->id] = $pc->title;
        }

        return view(\App::getLocale() . '.profile.product.edit', compact('product', 'product_cats', 'companies'));
    }

}
