<!-- categories -->
<aside id="column-left" class="col-sm-3">

    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="{{ image_url(Auth::user()->avatar , 135, 135 ) }}" class="img-responsive" alt="">
                    </div>

                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name" >
                            {{ Auth::user()->name . ' ' . Auth::user()->family }}
                        </div>
                    </div>

                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="{{ \Request::route()->getName() == 'profile.index' ? ' active ' : '' }}">
                                <a href="{{ route('profile.index') }}">
                                    <i class="fa fa-home"></i>
                                    @lang('custom.dashboard')
                                </a>
                            </li>
                            <li class="{{ \Request::route()->getName() == 'course.cat.list' ? ' active ' : '' }}">
                                <a href="{{ route('course.cat.list') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    @lang('custom.all_cat')
                                </a>
                            </li>
                            <li class="{{ \Request::route()->getName() == 'course.index' ? ' active ' : '' }}">
                                <a href="{{ route('course.index') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    @lang('custom.content_list')
                                </a>
                            </li>
                            {{--<li class="">
                                <a href="#">
                                    <i class="fa fa-envelope"></i>
                                    بایگانی پیامها <em>(۳۴۳)</em></a>
                            </li>--}}
                            {{--<li class="{{ \Request::route()->getName() == 'sub_scriptions.index' ? ' active ' : '' }}">
                                <a href="{{ route('sub_scriptions.index') }}">
                                    <i class="fa fa-bank"></i>
                                    @lang('custom.subscriptions')
                                </a>
                            </li>
                            <li class="{{ \Request::route()->getName() == 'profile.products.create' ? ' active ' : '' }}">
                                <a href="{{ route('profile.products.create') }}">
                                    <i class="fa fa-plus"></i>
                                    @lang('custom.add_product')
                                </a>
                            </li>
                            <li class="{{ \Request::route()->getName() == 'profile.products.list' ? ' active ' : '' }}">
                                <a href="{{ route('profile.products.list') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    @lang('custom.my_products')
                                </a>
                            </li>--}}
                            {{--<li>
                                <a href="#">
                                    <i class="fa fa-money"></i>
                                    محصولات به فروش رسیده </a>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="fa fa-share"></i>
                                    فروش های نهایی شده</a>
                            </li>--}}
                            {{--<li class="{{ \Request::route()->getName() == 'products.order.list' ? ' active ' : '' }}">
                                <a href="{{ route('products.order.list') }}">
                                    <i class="fa fa-archive"></i>
                                @lang('custom.your_order')
                                </a>
                            </li>
                            <li class="{{ \Request::route()->getName() == 'products.sale.list' ? ' active ' : '' }}">
                                <a href="{{ route('products.sale.list') }}">
                                    <i class="fa fa-archive"></i>
                                    @lang('custom.your_sale')
                                </a>
                            </li>
                            <li class="{{ \Request::route()->getName() == 'products.order.list' ? ' active ' : '' }}">
                                <a href="{{ route('products.order.list') }}">
                                    <i class="fa fa-archive"></i>
                                    @lang('custom.favorite_products')
                                </a>
                            </li>
                            <li class="{{ \Request::route()->getName() == 'profile.company.list' ? ' active ' : '' }}">
                                <a href="{{ route('profile.company.list') }}">
                                    <i class="fa fa-archive"></i>
                                    @lang('custom.company_list_mine')
                                </a>
                            </li>--}}
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="fa fa-sign-in"></i>
                                    @lang('custom.close')
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

</aside>

