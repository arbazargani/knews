<?php

namespace App\Http\Controllers;

use App\User;
use App\UserCompany;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{

    public function upload_editor(Request $request)
    {
        return view('user.upload_editor');
//        abort(503);
        //return view('partials.attachment',['field_title' => \Lang::get('custom.select_file'), 'field_name' => 'file_url', 'file_types' => 'pdf']);
        //@include('partials.attachment',['field_title' => Lang::get('custom.article_file'), 'field_name' => 'file_url', 'file_types' => 'pdf'])
    }

    public function upload_file(Request $request)
    {
        if(!empty($request->user_id))
            $output_dir = 'files'.'/'.$request->user_id;
        else
            $output_dir = 'files'.'/'.$request->user()->_id;
        $filesize = $request->file('myfile')->getClientSize();

        if ($filesize > 524288000)
            return response()->json([
                'err' => 'اندازه ی فایل بزرگ تر از 500MB می باشد.',
            ]);

        $filetype = $request->file('myfile')->getClientMimeType();
        if ($filetype != 'image/jpeg'
            && $filetype != 'application/msword' && $filetype != 'application/vnd.ms-powerpoint'
            && $filetype != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            && $filetype != 'application/vnd.openxmlformats-officedocument.presentationml.presentation' && $filetype != 'image/png'
            && $filetype != 'image/jpg' && $filetype != 'audio/mpeg' && $filetype != 'video/mp4'
            && $filetype != 'application/pdf' && $filetype != 'application/x-pdf' && $filetype != 'application/acrobat'
            && $filetype !=  'applications/vnd.pdf' && $filetype !=  'text/pdf' && $filetype !=  'text/x-pdf' && $filetype !=  'image/gif'
        ) {
            return response()->json([
                'err' => 'فایل ارسالی دارای مشکل می باشد.',
            ]);
        }

        #dd(Input::file('myfile')->guessClientExtension());
        #dd(Input::file('myfile')->getClientSize());
        #dd(Input::file('myfile')->getClientOriginalName());
        #dd(Input::file('myfile')->getFilename());


        if (isset($_FILES["myfile"])) {
            $ret = array();

            $error = $_FILES["myfile"]["error"];
            if (!is_array($_FILES["myfile"]["name"])) //single file
            {
                $final_img_name = strtotime('now').rand(0,10000).rand(0,10000);
                $file_type = basename($_FILES["myfile"]["name"]);
                $file_type = explode(".", $file_type);
                $i = count($file_type);
                $file_type = $file_type[$i - 1];
                $fileName = $final_img_name . "." . $file_type;
                move_uploaded_file($_FILES["myfile"]["tmp_name"], public_path($output_dir. $fileName));
                $ret[] = array("filename" => $fileName, "org_filename" => $_FILES["myfile"]["name"]);
            } else  //Multiple files, file[]
            {
                $fileCount = count($_FILES["myfile"]["name"]);
                for ($i = 0; $i < $fileCount; $i++) {
                    $fileName = $_FILES["myfile"]["name"][$i];
                    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], public_path($output_dir .'/'. $fileName));
                    #$ret[]= $fileName;
                    $ret[] = array("filename" => $fileName, "org_filename" => $_FILES["myfile"]["name"]);
                }
            }

            return response()->json($ret);
        }
    }

    public function upload_editor_file(Request $request)
    {
        return view('user.upload_editor_file');
    }

    public function dashboard()
    {
        return view('news._admin.create');
    }

    public function getLogin()
    {
        if(!Auth::check())
            return view( 'auth.login' );
        else
            if(Auth::user()->isadmin == 'yes')
                return redirect(route('admin.dashboard'));
            else
                return redirect(route('home'));
//                return redirect(route('profile.index'));
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
//            'txtcaptcha' => 'required|captcha',
        ], [], [
            'email' => 'نام کاربری',
            'password' => 'کلمه عبور',
//            'txtcaptcha' => 'کد امنیتی ',
        ]);

        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $field => $request->email,
            'password' => $request->password,
        ];

        if (Auth::validate($credentials)) {

            $user = Auth::getLastAttempted();

            if ($user->status == 'active') {

                Auth::login($user, $request->has('remember'));
                return redirect(route('admin.dashboard'));
                if(is_null($request->session()->get('url')['intended']) || $request->session()->get('url')['intended'] == route('logout')){
//                    return redirect(route('profile.index'));
                    return redirect(route('admin.dashboard'));
                }
                else
                    return redirect($request->session()->get('url')['intended']);

            } else {
                switch ($user->status) {
                    case 'deactive':
                        $errors = new MessageBag([
                            'email' => ['اکانت شما غیرفعال می باشد.'],
                            'password' => ['اطلاعات وارد شده صحیح نمی باشد.']
                        ]);
                        return \Redirect::back()->withErrors($errors);
                    case 'suspend':
                        $errors = new MessageBag([
                            'email' => ['اکانت شما تعلیق شده است!',],
                            'password' => ['اطلاعات وارد شده صحیح نمی باشد.']
                        ]);
                        return \Redirect::back()->withErrors($errors);
                    default:
                        $errors = new MessageBag([
                            'email' =>  ['اطلاعات وارد شده صحیح نمی باشد.'],
                            'password' => ['اطلاعات وارد شده صحیح نمی باشد.']
                        ]);
                        return \Redirect::back()->withErrors($errors);
                }
            }
        }

        $errors = new MessageBag([
            'email' => ['اطلاعات وارد شده صحیح نمی باشد.'],
            'password' => ['اطلاعات وارد شده صحیح نمی باشد.']
        ]);
        return \Redirect::back()->withErrors($errors);

    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->guest('login');
    }

    public function changelang(Request $request)
    {
        $dest = $request->redirect ;
        $dest = explode('/',$dest);

        if(!empty($dest)){
            if ( array_key_exists($dest[0], config('app.locales'))) {
                if ( array_key_exists($request->code, config('app.locales'))) {
                    \App::setLocale($request->code);
                    array_shift($dest);
                    return redirect(url($request->code.'/'.implode('/',$dest)));
                }
            }
            else{
                if ( array_key_exists($request->code, config('app.locales'))) {
                    \App::setLocale($request->code);
                    return redirect(url($request->code.'/'.implode('/',$dest)));
                }
            }
        }
        return redirect(url('/'));
    }

    public function register()
    {
        return view( \App::getLocale() .'.auth.register' );
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:1',
            'confirm' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required',
            'country_id' => 'required',
            'company' => 'required',
            'zone' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'tel' => 'required',
            'newsletter' => 'required',
            'agree' => 'required',
        ], [], [
            'email' => trans('auth.email'),
            'password' => trans('auth.password'),
            'confirm' => trans('auth.password'),
            'firstname' => trans('auth.name'),
            'lastname' => trans('auth.family'),
            'mobile' => trans('auth.mobile'),
            'company' => trans('auth.company'),
            'country_id' => trans('auth.country'),
            'zone' => trans('auth.zone'),
            'city' => trans('auth.city'),
            'postcode' => trans('auth.postcode'),
            'tel' => trans('auth.tel'),
            'newsletter' => trans('auth.newsletter'),
            'agree' => trans('auth.rule'),
        ]);

        if($request->password != $request->confirm){
            $errors = new MessageBag([
                'password' => ['رمزعبور یکسان وارد نشده است.']
            ]);
            return \Redirect::back()->withErrors($errors);
        }

        $user_new = new User;
        $user_new->name = $request->firstname ;
        $user_new->family = $request->lastname ;
        $user_new->mobile = $request->mobile ;
        $user_new->email = $request->email ;
        $user_new->username = $request->email ;
        $user_new->password = bcrypt($request->firstname) ;
        $user_new->newsletter = $request->newsletter ;
        $user_new->save() ;

        $usr_company = new UserCompany ;
        $usr_company->user_id = $user_new->id ;
        $usr_company->company_name = $request->company ;
        $usr_company->company_addr= $request->address ;
        $usr_company->country_id= $request->country_id ;
        $usr_company->zone_id= $request->zone ;
        $usr_company->city= $request->city ;
        $usr_company->postcode= $request->postcode ;
        $usr_company->tel= $request->tel ;
        $usr_company->fax= $request->fax ;
        $usr_company->save();

        Auth::loginUsingId($user_new->id);
        return redirect('/');

    }

}
