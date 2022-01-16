@extends('_layouts.admin')
@section('menu_active', 'news')

@section('title', "نمایش خبر: ". $news->title)

@section('page-bar')
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i> <a href="{{ route('admin.index') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.news.index') }}">لیست اخبار</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<span>نمایش خبر</span>
		</li>
	</ul>

	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="{{ route('admin.news.create') }}"> <i class="icon-user"></i> ثبت خبر جدید</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="{{ route('admin.news.index', 'draft') }}"> <i class="icon-bell"></i> لیست اخبار پیش نویس</a>
				</li>
				<li>
					<a href="{{ route('admin.news.index') }}"> <i class="icon-bell"></i> لیست اخبار من</a>
				</li>
				<li>
					<a href="{{ route('admin.news.index', 'inbox') }}"> <i class="icon-bell"></i> لیست اخبار دریافتی</a>
				</li>
				<li>
					<a href="{{ route('admin.news.index', 'outbox') }}"> <i class="icon-shield"></i> لیست اخبار ارسالی</a>
				</li>
				<li>
					<a href="{{ route('admin.news.index', 'all') }}"> <i class="icon-shield"></i> لیست جامع اخبار</a>
				</li>
			</ul>
		</div>
	</div>
@endsection

@section('content')
	<h3 class="page-title"> نمایش خبر:
		<small>{{ $news->title }}</small>
	</h3>

	<table class="table table-striped table-hover">
		<tr>
			<td class="col-sm-2 text-right">روتیتر:</td>
			<td>@if($news->pre_title) {{ $news->pre_title }} @else <span class="text-danger">-----</span> @endif</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">عنوان:</td>
			<td>{{ $news->title }}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">زیرتیتر:</td>
			<td>@if($news->post_title) {{ $news->post_title }} @else <span class="text-danger">-----</span> @endif</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">لید:</td>
			<td>{!! $news->summary !!}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">متن:</td>
			<td>{!! $news->text !!}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">سرویس:</td>
			<td>{{ $news->service->title }}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">نویسنده:</td>
			<td>{{ $news->user->fname .' '. $news->user->lname }}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">تصویر شاخص:</td>
			<td><img class="thumbnail" src="{{ image_url($news->image, 15, 15) }}" alt="{{ $news->title }}"></td>
		</tr>
		@if( !empty($news->gallery) )
			<tr>
				<td class="col-sm-2 text-right">گالری تصاویر:</td>
				<td>
					<div class="row">
						@foreach($news->gallery as $image)
							<div class="col-md-2 col-sm-3 col-xs-6">
								<div class="thumbnail">
									<img src="{{ image_url($image['src'], 15, 15, true) }}" alt="{{ $image['alt'] }}">
									<div class="caption">
										{{ $image['alt'] }}
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</td>
			</tr>
		@endif
		@if( !empty($news->video) )
			<tr>
				<td class="col-sm-2 text-right">فیلم:</td>
				<td lang="en">{{ $news->video }}</td>
			</tr>
		@endif
		@if( !empty($news->sound) )
			<tr>
				<td class="col-sm-2 text-right">صدا:</td>
				<td lang="en">{{ $news->sound }}</td>
			</tr>
		@endif
		@if( !empty($news->document) )
			<tr>
				<td class="col-sm-2 text-right">سند:</td>
				<td lang="en">{{ $news->document }}</td>
			</tr>
		@endif
		@if( !empty($news->tagsOnly) )
			<tr>
				<td class="col-sm-2 text-right">تگ ها:</td>
				<td>
					@foreach($news->tagsOnly as $tag)
						<span style="margin-left: 25px">{{ $tag->title }}</span>
					@endforeach
				</td>
			</tr>
		@endif
		<tr>
			<td class="col-sm-2 text-right">تاریخ ثبت:</td>
			<td class="jalali" data-format="datetime">{{ $news->created_at }}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">تاریخ آخرین ویرایش:</td>
			<td class="jalali" data-format="datetime">{{ $news->updated_at }}</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">تاریخ انتشار:</td>
			<td>
				@if($news->published_at)
					<span class="jalali" data-format="datetime">{{ $news->published_at }}</span>
				@else
					<span class="text-danger">عدم انتشار</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="col-sm-2 text-right">تاریخ غیر فعال شدن:</td>
			<td>
				@if($news->deleted_at)
					<span class="jalali" data-format="datetime">{{ $news->deleted_at }}</span>
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