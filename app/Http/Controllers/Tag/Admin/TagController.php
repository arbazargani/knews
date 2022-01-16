<?php

namespace App\Http\Controllers\Tag\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tag;

class TagController extends Controller
{
	public function items(Request $request)
	{
		$query = Tag::where('title', 'LIKE', "%{$request->input('query')}%");

		$count = $query->count('id');

		$page = $request->has('page') ? $request->input('page') : 1;
		$rows = 30;
		$offset = ($page - 1) * 30;

		return [
			'total' => $count,
			'rows' => $query->skip($offset)->take($rows)->get(['id','title','order'])->toArray(),
		];
	}

    public function index()
    {
        return view('tag._admin.index');
    }

    public function create()
    {
        return view('tag._admin.create');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tag._admin.edit', compact('tag'));
    }

    public function _list(Request $request)
    {
        $query = Tag::where('is_system',0)->where('user_id', $request->user()->id);

        if ($request->has('filterRules')) {
            $filters = json_decode($request->get('filterRules'), true);
            foreach ($filters as $filter) {
                if ($filter['field'] == 'title')
                    $query->where($filter['field'], 'LIKE', "%{$filter['value']}%");
                elseif ($filter['field'] == 'status') {
                    $query->where($filter['field'], $filter['value']);
                } elseif ($filter['field'] == 'tag_type') {
                    $query->where($filter['field'], $filter['value']);
                } elseif ($filter['field'] == 'slider') {
                    $query->where($filter['field'], $filter['value']);
                } elseif ($filter['field'] == 'created_at') {
                    $filter['value'] = \jDateTime::createDatetimeFromFormat('Y/m/d h:i:s', str_replace('  ', ' ', convertPersianToEnglishDigits($filter['value'])));
                    if ($filter['op'] == 'greater')
                        $query->where($filter['field'], '>', $filter['value']);
                    elseif ($filter['op'] == 'less')
                        $query->where($filter['field'], '<', $filter['value']);
                }
            }
        }

        $count = $query->count();
        $sort = $request->has('sort') ? $request->input('sort') : 'created_at';
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
            'rows' => $query->skip($offset)->take($rows)->get(['id', 'title','order', 'created_at']),
        ];

    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'edit_id' => 'required',
            'title' => 'required',
        ], [], [
            'edit_id' => 'عنوان',
            'title' => 'عنوان',
        ]);

        $tag = Tag::find($request->edit_id);
        $tag->title = $request->title;
        $tag->order = !empty($request->order)?$request->order:0;
        $tag->user_id = $request->user()->id;

        if ($tag->save()) {

            return [
                'ok' => true,
                'message' => 'تبلیغ  به درستی ویرایش گردید',
            ];
        }

        return [
            'ok' => false,
            'message' => 'ثبت با مشکل رو برو شد!',
        ];
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required',

        ], [], [
            'post_id' => 'عنوان',
        ]);

        if (Tag::destroy($request->post_id)) {
            return [
                'ok' => true,
                'message' => 'حذف تبلیغ با موفقیت انجام شد',
            ];
        }

        return [
            'ok' => false,
            'message' => 'خطا در حذف تبلیغ!',
        ];

    }

    public function deactive(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required',

        ], [], [
            'post_id' => 'عنوان',
        ]);

        $tag = Tag::findOrFail($request->post_id);
        if ($tag->status == 'deactive')
            $tag->status = 'active';
        else
            $tag->status = 'deactive';

        if ($tag->save()) {
            return [
                'ok' => true,
                'message' => 'تغییر وضعیت تبلیغ با موفقیت انجام شد',
            ];
        }

        return [
            'ok' => false,
            'message' => 'خطا !',
        ];

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ], [], [
            'title' => 'عنوان',
        ]);

        $tag = new Tag();
        $tag->title = $request->title;
        $tag->order = !empty($request->order)?$request->order:0;
        $tag->user_id = $request->user()->id;

        if ($tag->save()) {

            return [
                'ok' => true,
                'message' => 'تبلیغ جدید به درستی ثبت گردید',
            ];
        }

        return [
            'ok' => false,
            'message' => 'ثبت با مشکل رو برو شد!',
        ];

    }

}
