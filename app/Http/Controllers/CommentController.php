<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required',
            'module' => 'required',
            'name' => 'required',
            'text' => 'required',
            'txtcaptcha' => 'required|captcha',
        ], [
            'txtcaptcha.captcha' => trans('custom.captcha_code')
        ], [
            'post_id' => trans('custom.name'),
            'module' => trans('custom.name'),
            'name' => trans('custom.name'),
            'text' => trans('custom.your_comment'),
            'txtcaptcha' => trans('custom.captcha_code'),
        ]);

        $comt = new Comment;
        $comt->user_id = (isset($request->user()->id)) ? $request->user()->id : 0;
        $comt->post_id = $request->post_id;
        $comt->name = $request->name;
        $comt->descr = $request->text;
        $comt->module = $request->module;
        $comt->status = 'deactive';
        if ($comt->save()) {
            return [
                'ok' => true,
                'msg' => trans('custom.correct_insert'),
            ];
        } else
            return [
                'ok' => false,
                'msg' => trans('custom.incorrect_insert')
            ];

    }
}
