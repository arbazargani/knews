@extends('_layouts.admin')
@section('menu_active', 'user')

@section('title', "مشاهده نقش: {$role->title}")

@section('page-bar')
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i> <a href="{{ route('admin.index') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.user.index') }}">لیست اعضا</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.user.role.index') }}">لیست نقش ها</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<span>مشاهده نقش</span>
		</li>
	</ul>

	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="{{ route('admin.user.role.edit', $role->id) }}"> <i class="fa fa-check"></i> ویرایش نقش</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="{{ route('admin.user.role.create') }}"> <i class="fa fa-check"></i> ثبت نقش جدید</a>
				</li>
				<li>
					<a href="{{ route('admin.user.role.index') }}"> <i class="fa fa-check"></i> لیست نقش ها</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="{{ route('admin.user.index') }}"> <i class="fa fa-check"></i> لیست اعضا</a>
				</li>
			</ul>
		</div>
	</div>
@endsection

@section('content')
	<h3 class="page-title"> نمایش نقش:
		<small>{{$role->title}}</small>
	</h3>

	<table class="table table-striped table-hover">
		<tr>
			<td class="col-sm-2 text-right">عنوان:</td>
			<td>{{ $role->title }}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">سطح:</td>
			<td>{{ $role->level }}</td>
		</tr>
		{{--
		<tr>
			<td class="col-sm-2 text-right">سرویس ها:</td>
			<td>
				@forelse($role->servicesOnly as $row)
					<p>{ {$row->title}}</p>
				@empty
					<p class="text-danger">هیچ سرویسی انتساب داده نشده</p>
				@endforelse
			</td>
		</tr>
		--}}
		<tr>
			<td class="col-sm-2 text-right">پوشه ها:</td>
			<td>
				@if(empty($role->dirs))
					<p class="text-danger">هیچ پوشه ای انتساب داده نشده</p>
				@else
					@foreach($role->dirs as $key => $row)
						<p>
						<span lang="en">{{$key}}</span>
						@if(isset($row['r']))
							<span>خواندن</span>
						@endif
						@if(isset($row['w']))
							<span>نوشتن</span>
						@endif
						</p>
					@endforeach
				@endif
			</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">تاریخ ثبت:</td>
			<td class="jalali" data-format="datetime">{{ $role->created_at }}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">تاریخ آخرین ویرایش:</td>
			<td class="jalali" data-format="datetime">{{ $role->updated_at }}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">تاریخ غیر فعال شدن:</td>
			<td>
				@if($role->deleted_at)
					<span class="jalali" data-format="datetime">{{ $role->deleted_at }}</span>
				@else
					<span class="text-success">فعال</span>
				@endif
			</td>
		</tr>
	</table>
@endsection


@push('script')
<script type="text/javascript" src="{{ asset('assets/js/jalaali.js')  }}"></script>
@endpush