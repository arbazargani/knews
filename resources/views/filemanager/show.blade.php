@extends('_layouts.admin')
@section('menu_active', 'pic')

@section('title', 'مدیریت تصاویر')

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="{{ route('admin.dashboard') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <a href="{{ route('admin.news.index') }}">لیست فایل ها</a> <i class="fa fa-angle-double-left"></i>
        </li>

    </ul>

@endsection

@section('content')
    <h3 class="page-title"> مدیریت فایل ها:
        <small>از طریق فرم زیر اقدام به مدیریت فایل ها نمایید.</small>
    </h3>

    <div class="portlet light bordered">
        <iframe width="100%" frameBorder="0" height="450px" src="{{ url('fa/filemanager') }}"></iframe>
    </div>
@endsection