<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use App\SiteSetting;
use Illuminate\Http\Request;
use App\User;


class UserController extends Controller
{
    public function index()
    {
        return view('user._admin.index');
    }

    public function index_items(Request $request)
    {
        $query = User::select('id', 'name', 'family', 'username', 'email', 'created_at', 'updated_at');

        $count = $query->count();

        $sort = $request->has('sort') ? $request->input('sort') : 'id';
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
            'rows' => $query->skip($offset)->take($rows)->get(),
        ];
    }

    public function create()
    {
        return view('user._admin.create');
    }

    public function store(Request $request)
    {
        $this->requestTrim($request, ['fname', 'lname', 'email', 'username']);

        $this->validate($request, [
            'username' => ['required', 'min:4', 'max:25', 'regex:/^[\w\-\.]+$/', 'unique:users,username'],
            'email' => 'required|min:5|max:50|email|unique:users,email',
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password',
            'fname' => 'required|min:3|max:25',
            'lname' => 'required|min:3|max:25',
        ], [], [
            'username' => 'نام کاربری',
            'email' => 'پست الکترونیکی',
            'password' => 'رمز عبور',
            'password_confirmation' => 'تکرار رمز عبور',
            'fname' => 'نام',
            'lname' => 'نام خانوادگی',
        ]);

        $inputs = $request->all();

        $user = new User();
        $user->name = $inputs['fname'];
        $user->family = $inputs['lname'];
        $user->username = $inputs['username'];
        $user->password = bcrypt($inputs['password']);
        $user->email = $inputs['email'];
        $user->mobile = $inputs['mobile'];
        if ($user->save()) {
            return [
                'ok' => true,
                'id' => $user->id,
            ];
        }
        return [
            'ok' => false,
        ];
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user._admin.show', compact('user'));
    }

    public function edit($id)
    {
        /*if ($id <= 1)
            abort(403);*/

        $user = User::findOrFail($id);

        return view('user._admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        /*if ($id <= 1)
            abort(403);*/

        $this->requestTrim($request, ['fname', 'lname', 'email', 'username']);

        $this->validate($request, [
            'fname' => 'required|min:3|max:25',
            'lname' => 'required|min:3|max:25',
            'email' => 'required|min:5|max:50|email|unique:users,email,' . $id,
            'username' => ['required', 'min:4', 'max:25', 'regex:/^[\w\-\.]+$/', 'unique:users,username,' . $id],
            'password' => 'min:5',
            'password_confirmation' => 'same:password',
        ], [], [
            'fname' => 'نام',
            'lname' => 'نام خانوادگی',
            'email' => 'پست الکترونیکی',
            'username' => 'نام کاربری',
            'password' => 'رمز عبور',
            'password_confirmation' => 'تکرار رمز عبور',
        ]);

        $inputs = $request->all();

        $user = User::findOrFail($id);
        $user->name = $inputs['fname'];
        $user->family = $inputs['lname'];
        $user->email = $inputs['email'];
        $user->username = $inputs['username'];
        $user->mobile = $inputs['mobile'];

        if (!empty($inputs['password']))
            $user->password = bcrypt($inputs['password']);

        if ($user->save()) {

            return [
                'ok' => true,
                'id' => $user->id,
            ];
        }
        return [
            'ok' => false,
        ];
    }

    public function destroy(Request $request, $id)
    {
        /*if ($id <= 1)
            abort(403);*/

        if ($request->user()->id == $id) {
            return [
                'ok' => false,
                'message' => 'شما نمی توانید اکانت خودتان را حذف نمایید!',
            ];
        } else {
            $user = User::findOrFail($id);
            try {
                $user->delete();
                return [
                    'ok' => true,
                    'message' => 'کاربر بدرستی حذف گردید.',
                ];
            } catch (\Illuminate\Database\QueryException $e) {
                return [
                    'ok' => false,
                    'message' => 'این کاربر قابل حذف نمی باشد!',
                ];
            }
        }
    }

    public function active(Request $request, $id)
    {
        /*if ($id <= 1)
            abort(403);*/

        if ($request->user()->id == $id) {
            return [
                'ok' => false,
                'message' => 'شما نمی توانید اکانت خودتان را تغییر دهید',
            ];
        } else {
            $user = User::findOrFail($id);
            if ($user->status == 'deactive') {
                $user->status = 'active';
                $user->save();
                return [
                    'ok' => true,
                    'message' => 'کاربر بدرستی فعال شد!',
                ];
            } else {
                $user->status = 'deactive';
                $user->save();
                return [
                    'ok' => true,
                    'message' => 'کاربر بدرستی غیرفعال شد!',
                ];
            }
        }
    }

    public function site_setting()
    {
        $site_setting = SiteSetting::find(1);
        return view('user._admin.site_setting' ,compact('site_setting'));
    }
    public function site_setting_post(Request $request)
    {
        $this->requestTrim($request, ['bk_color', 'color']);

        $this->validate($request, [
            'bk_color' => 'required',
            'color' => 'required',
        ], [], [
            'bk_color' => 'رنگ زمینه',
            'color' => 'رنگ',
        ]);
        $site_setting = SiteSetting::find(1);
        $site_setting->bk_color_menu = $request->bk_color ;
        $site_setting->color_menu = $request->color ;

        $site_setting->bk_color_footer = $request->bk_color_footer ;
        $site_setting->color_footer = $request->color_footer ;
        $site_setting->title_color_footer = $request->title_color_footer ;
        $site_setting->hover_color_footer = $request->hover_color_footer ;

        $site_setting->save();

        return [
            'ok'=>true
        ];


    }

}
