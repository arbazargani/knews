<?php

namespace App\Libraries;

class Menu
{
    public function admin()
    {
        #$menu = [];

        $menu = [
            [
                'id' => 'menu-dashboard',
                'title' => 'پیشخوان',
                'icon' => 'icon-home',
                'sub' => [
                    [
                        'title' => 'مشاهده سایت',
                        'link' => route('home'),
                        'icon' => 'icon-home',
                    ],
//                    [
//                        'title' => 'ویرایش اطلاعات کاربری',
//                        'link' => route('admin.users.edit', ['id' => \Auth::user()->id]),
//                        'icon' => 'icon-diamond',
//                    ],
//                    [
//                        'title' => 'تنظیمات',
//                        'link' => route('admin.site.setting'),
//                        'icon' => 'icon-diamond',
//                    ],
                ],
            ],
        ];

        $sub = [];
        $sub[] = [
            'title' => 'ثبت خبر  جدید',
            'link' => route('admin.news.create'),
            'icon' => 'icon-diamond',
        ];
        $sub[] = [
            'title' => 'لیست خبر ها',
            'link' => route('admin.news.index'),
            'icon' => 'icon-diamond',
        ];
/*
        if(\Auth::user()->isadmin == 'yes') {
            $sub[] = [
                'title' => ' دسته بندی جدید خبر',
                'link' => route('admin.cat.create', ['news']),
                'icon' => 'icon-diamond',
            ];
            $sub[] = [
                'title' => 'لیست دسته بندی خبر',
                'link' => route('admin.cat.index', ['news']),
                'icon' => 'icon-diamond',
            ];
        }
*/
//
//        $sub[] = [
//            'title' => 'لیست اسلایدرها',
//            'link' => route('admin.news.slider.list'),
//            'icon' => 'icon-diamond',
//        ];


        $menu[] = [
            'id' => 'menu-news',
            'title' => 'مدیریت خبر ها',
            'icon' => 'fa fa-newspaper-o',
            'sub' => $sub,
        ];

        $sub = [];

        /* $sub[] = [
             'title' => ' ایجاد دسته بندی ',
             'link' => route('admin.cat.create', ['staticpage']),
             'icon' => 'icon-diamond',
         ];
         $sub[] = [
             'title' => 'لیست دسته بندی ها',
             'link' => route('admin.cat.index', ['staticpage']),
             'icon' => 'icon-diamond',
         ];

        $sub[] = [
             'title' => 'ایجاد صفحه ی جدید',
             'link' => route('admin.staticpage.create'),
             'icon' => 'icon-diamond',
         ];
         $sub[] = [
             'title' => 'لیست صفحات',
             'link' => route('admin.staticpage.index'),
             'icon' => 'icon-diamond',
         ];

         $menu[] = [
             'id' => 'menu-staticpage',
             'title' => 'مدیریت صفحات ثابت',
             'icon' => 'fa fa-newspaper-o',
             'sub' => $sub,
         ];
         */

        if(\Auth::user()->isadmin == 'yes') {
            $sub = [];
            $sub[] = [
                'title' => 'ثبت تبلیغ جدید',
                'link' => route('admin.ads.create'),
                'icon' => 'icon-diamond',
            ];
            $sub[] = [
                'title' => 'لیست تبلیغات',
                'link' => route('admin.ads.index'),
                'icon' => 'icon-diamond',
            ];

            $menu[] = [
                'id' => 'menu-ads',
                'title' => 'مدیریت تبلیغات',
                'icon' => 'fa fa-newspaper-o',
                'sub' => $sub,
            ];


            $sub = [];
            $sub[] = [
                'title' => 'ثبت تگ جدید',
                'link' => route('admin.tag.create'),
                'icon' => 'icon-diamond',
            ];
            $sub[] = [
                'title' => 'لیست تگ ها',
                'link' => route('admin.tag.index'),
                'icon' => 'icon-diamond',
            ];

            $menu[] = [
                'id' => 'menu-ads',
                'title' => 'مدیریت تگ ها',
                'icon' => 'fa fa-newspaper-o',
                'sub' => $sub,
            ];


            $sub = [];
            $sub[] = [
                'title' => 'تصاویر',
                'link' => route('admin.filemanager.show'),
                'icon' => 'icon-diamond',
            ];

            $menu[] = [
                'id' => 'menu-pic',
                'title' => 'مدیریت تصاویر',
                'icon' => 'fa fa-newspaper-o',
                'sub' => $sub,
            ];


            $sub = [];
            $sub[] = [
                'title' => 'ثبت کاربر جدید',
                'link' => route('admin.users.create'),
                'icon' => 'icon-diamond',
            ];
            $sub[] = [
                'title' => 'لیست کاربران',
                'link' => route('admin.users.index'),
                'icon' => 'icon-diamond',
            ];
            $menu[] = [
                'id' => 'menu-user',
                'title' => 'مدیریت کاربران',
                'icon' => 'icon-user',
                'sub' => $sub,
            ];

            $sub = [];
            $sub[] = [
                'title' => 'درباره ما',
                'link' => route('admin.aboutus', ['lang' => 'fa']),
                'icon' => 'icon-diamond',
            ];
            $sub[] = [
                'title' => 'تماس با ما',
                'link' => route('admin.contactus'),
                'icon' => 'icon-diamond',
            ];

            $menu[] = [
                'id' => 'menu-contactus',
                'title' => 'تماس با ما',
                'icon' => 'fa fa-newspaper-o',
                'sub' => $sub,
            ];
        }
        return $menu;

    }

}