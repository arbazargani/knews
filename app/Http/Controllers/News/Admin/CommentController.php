<?php

namespace App\Http\Controllers\News\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\NewsComment;
use App\News;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('news._admin.comment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = NewsComment::findOrFail($id);
        $news = News::where('id', $comment->news_id)->withTrashed()->firstOrFail();

        return view('news._admin.comment.show', compact('comment', 'news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = NewsComment::findOrFail($id);
        #return $comment;
        return view('news._admin.comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->requestTrim($request, ['name', 'text']);

        $this->validate($request, [
            'name' => 'required|max:50',
            'text' => 'required|max:1000',
        ], [], [
            'name' => 'نام',
            'text' => 'متن نظر',
        ]);

        $comment = NewsComment::findOrFail($id);
        $comment->name = $request->input('name');
        $comment->text = nl2br(nl2one($request->input('text')));
        $comment->is_show = !!$request->input('status');
        $comment->save();

        return [
            'ok' => true,
            'message' => 'نظر بدرستی ویرایش گردید.',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NewsComment::destroy($id);
        return [
            'ok' => true,
            'message' => 'نظر بدرستی حذف گردید',
        ];
    }

    public function items()
    {
        return NewsComment::select('id', 'name', 'text', 'is_show', 'created_at', 'updated_at')->get()->toArray();
    }

    public function active($id)
    {
        $comment = NewsComment::findOrFail($id);
        $comment->is_show = !$comment->is_show;
        $comment->save();

        if( $comment->is_show )
        {
            return [
                'ok' => true,
                'message' => 'نظر بدرستی فعال گردید',
            ];
        }
        else
        {
            return [
                'ok' => true,
                'message' => 'نظر بدرستی غیر فعال گردید',
            ];
        }
    }
}
