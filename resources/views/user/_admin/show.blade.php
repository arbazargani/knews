@extends('_layouts.admin')
@section('menu_active', 'user')

@section('title', "نمایش کابر: {$user->lname} - {$user->fname}")

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="{{ route('admin.dashboard') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}">لیست اعضا</a> <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>نمایش اطلاعات</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع <i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="{{ route('admin.users.edit', $user->id) }}"> <i class="fa fa-check"></i> ویرایش اطلاعات</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('admin.users.index') }}"> <i class="fa fa-check"></i> لیست کاربران</a>
                </li>
                <li class="divider"></li>
               
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <h3 class="page-title"> ثبت کاربر جدید:
        <small>از طریق فرم زیر اقدام به تعریف کاربر جدید نمایید.</small>
    </h3>

    <table class="table table-striped table-hover">
        <tr>
            <td class="col-sm-2 text-right">نام:</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td class="col-sm-2 text-right">نام خانوادگی:</td>
            <td>{{ $user->family }}</td>
        </tr>
        <tr>
            <td class="col-sm-2 text-right">رایانامه:</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td class="col-sm-2 text-right">نام کاربری:</td>
            <td>{{ $user->username }}</td>
        </tr>

        @push('script')
        <script type="text/javascript" src="{{ asset('js/jalaali.js')  }}"></script>
        @endpush

        <tr>
            <td class="col-sm-2 text-right">تاریخ عضویت:</td>
            <td class="jalali">{{ $user->created_at }}</td>
        </tr>
        <tr>
            <td class="col-sm-2 text-right">تاریخ آخرین ویرایش:</td>
            <td  class="jalali">{{ $user->updated_at }}</td>
        </tr>

    </table>
@endsection