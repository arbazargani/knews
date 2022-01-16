@extends('_layouts.admin')
@section('menu_active', 'user')

@section('title', "ویرایش نقش: {$role->title}")

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
            <a href="{{ route('admin.user.role.show', $role->id) }}">مشاهده جزئیات</a> <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>ویرایش نقش</span>
        </li>
    </ul>

    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع<i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="{{ route('admin.user.role.show', $role->id) }}"> <i class="fa fa-check"></i> مشاهده نقش</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('admin.user.role.index') }}"> <i class="fa fa-check"></i> لیست نقش ها</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('admin.user.create') }}"> <i class="fa fa-check"></i> ثبت کاربر جدید</a>
                </li>
                <li>
                    <a href="{{ route('admin.user.index') }}"> <i class="fa fa-check"></i> لیست کاربران</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <h3 class="page-title"> ویرایش نقش:
        <small>از طریق فرم زیر میتوانید نقش را ویرایش نمایید.</small>
    </h3>

    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i> <span class="caption-subject bold uppercase"> ثبت خبر جدید</span>
            </div>
            <div class="actions">
                <div class="btn-group">
                    <button type="button" class="btn green btnFromSave">
                        <i class="fa fa-save"></i> ذخیره
                    </button>

                    <button data-toggle="dropdown" class="btn green dropdown-toggle">
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <!--
                        <li>
                            <a href="javascript:;"> <i class="fa fa-print"></i> چاپ </a>
                        </li>
                        <li class="divider"></li>
                        -->
                        <li>
                            <a href="javascript:;" class="btnFromReset"> <i class="fa fa-trash-o"></i> پاک کردن اطلاعات جاری</a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" title="تمام صفحه"> </a>
                <a class="btn btn-circle btn-icon-only btn-default tooltips" href="{{ route('admin.user.role.show', $role->id) }}" title="بازگشت"> <i class="fa fa-arrow-left"></i> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form id="frm1" role="form" method="POST" autocomplete="off">
                <input type="hidden" name="_method" value="put">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-3">

                            <div class="form-group">
                                <label class="control-label" for="input_title"><span class="text-danger">*</span> عنوان نقش:</label>
                                <div class="input-icon">
                                    <i class="fa fa-bell-o"></i> <input type="text" class="form-control" name="title" id="input_title" value="{{$role->title}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="input_level"><span class="text-danger">*</span> سطح:</label>
                                <div class="input-icon">
                                    <i class="fa fa-bell-o"></i> <input type="number" class="form-control" name="level" id="input_level" min="10" max="99" value="{{$role->level}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <legend>دسترسی ها</legend>
                                @foreach($modules as $module)
                                    @if( !$module->services->isEmpty() )
                                        <div class="form-group">
                                            <b>{{ $module->title }}</b>
                                            @foreach($module->permissions as $permission)
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permission_ids && in_array($permission->id, $role->permission_ids)) checked @endif>{{ $permission->title }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <legend>دسترسی ها</legend>
                                @foreach($modules as $module)
                                    @if( $module->services->isEmpty() )
                                        <div class="form-group">
                                            <b>{{ $module->title }}</b>
                                            @foreach($module->permissions as $permission)
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permission_ids && in_array($permission->id, $role->permission_ids)) checked @endif>{{ $permission->title }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </fieldset>
                        </div>

                        <div class="col-md-3">
                            <fieldset>
                                <legend>پوشه ها</legend>
                                <p><i aria-hidden="true" class="fa fa-eye"></i> = خواندن <i aria-hidden="true" class="fa fa-edit" style="margin-right:20px"></i> = نوشتن</p>
                                @foreach($dirs as $dir)
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="dirs[{{ $dir }}][r]" @if(isset($role->dirs[$dir]['r'])) checked @endif> <i aria-hidden="true" class="fa fa-eye"></i>
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="dirs[{{ $dir }}][w]" @if(isset($role->dirs[$dir]['w'])) checked @endif> <i aria-hidden="true" class="fa fa-edit"></i>
                                        </label>
                                        <b class="pull-right">{{ $dir }}</b>
                                        <div class="clearfix"></div>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn green btnFromSave"><i class="fa fa-save"></i>ذخیره</button>
                    <button type="button" class="btn red btnFromReset"><i class="fa fa-trash-o"></i>خالی کردن</button>
                    <a href="{{ route('admin.user.role.show', $role->id) }}" class="btn default"><i class="fa fa-arrow-left"></i>انصراف</a>

                    @push('script')
                    <script>
                        $(document).ready(function () {
                            $('.btnFromSave').click(function () {
                                var $this = $(this).prop('disabled', true);
                                var $form = $('#frm1');
                                $form.find('.has-error').removeClass('has-error');
                                $form.find('.help-block').remove();

                                $.post('{{ route('admin.user.role.update', $role->id) }}', $form.serialize(), function (data) {
                                    if (data.ok) {
                                        window.location.replace('{{ route('admin.user.role.show', $role->id) }}');
                                    } else {
                                        $this.prop('disabled', false);
                                    }
                                }, 'json').fail(function (jqXhr) {
                                    if (jqXhr.status === 401) //redirect if not authenticated user.
                                        window.location.replace('{{ route('login') }}');
                                    else if (jqXhr.status === 422) {
                                        $.each(jqXhr.responseJSON, function (key, value) {
                                            $('#input_' + key).after('<span class="help-block"> <strong>' + value[0] + '</strong> </span>').closest('.form-group').addClass('has-error');
                                        });
                                        $this.prop('disabled', false);
                                    } else
                                        $this.prop('disabled', false);
                                });
                            });

                            $('.btnFromReset').click(function () {
                                $('#frm1')[0].reset();
                                //$form.find('input').iCheck('update');
                            });
                        });
                    </script>
                    @endpush
                </div>
            </form>
        </div>
    </div>
@endsection