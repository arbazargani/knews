@extends('_layouts.admin')
@section('menu_active', 'news')

@section('title', "مشاهده نظر خبر")

@section('page-bar')
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i> <a href="{{ route('admin.index') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.news.index') }}">لیست اخبار</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.news.comment.index') }}">لیست نظرات</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<span>مشاهده نظر</span>
		</li>
	</ul>

	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="{{ route('admin.news.comment.index') }}"> <i class="icon-user"></i> لیست نظرات</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="{{ route('admin.news.index') }}"> <i class="icon-bell"></i> لیست اخبار</a>
				</li>
			</ul>
		</div>
	</div>
@endsection

@section('content')
	<h3 class="page-title"> نمایش نظر
		<small>خبر: <a href="{{ route('admin.news.show', $comment->news_id) }}">{{ $news->title }}</a></small>
	</h3>

	<table class="table table-striped table-hover">
		<tr>
			<td class="col-sm-2 text-right">نویسنده:</td>
			<td>{{ $comment->name }}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">ایمیل:</td>
			<td>
				@if( empty($comment->email) )
					<span class="text-danger">ندارد</span>
				@else
					<span dir="ltr">{{ $comment->email }}</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">متن:</td>
			<td>{!! $comment->text !!}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">وضعیت:</td>
			<td>
				@if( $comment->is_show )
					<span class="text-success">فعال</span>
				@else
					<span class="text-danger">غیر فعال</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">تاریخ ثبت:</td>
			<td class="jalali" data-format="datetime">{{ $comment->created_at }}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">تاریخ آخرین ویرایش:</td>
			<td class="jalali" data-format="datetime">{{ $comment->updated_at }}</td>
		</tr>
	</table>
@endsection


@push('script')
<script type="text/javascript" src="{{ asset('assets/js/jalaali.js')  }}"></script>
@endpush