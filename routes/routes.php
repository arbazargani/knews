<?php

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

// Route::get('/files/{filename}',  'HomeController@render_files');
// Route::get('/files/{dir}/{filename}.{ext}',  'HomeController@render_videoFiles');
// Route::get('/images/{filename}',  'HomeController@render_images');


Route::get('rand', function() {
    $random_data = \App\News::where('created_at', 'like', '%2015%')
    ->where('status', 'active')
    ->where('type', 'titr2')
    ->where('lang', \App::getLocale())
    ->inRandomOrder()
    ->limit(1)->get();
    return $random_data[0];
});

#### Json Home Content ####
Route::get('json/home/{page}', ['uses' => 'HomeController@jsonLoadMore', 'as' => 'json']);

Route::get('images{image}{type}{width}x{height}.{ext}', ['uses' => 'FileController@create'])->where(['image' => '(/[a-zA-Z0-9_\-\.]+)+', 'type' => '_|-', 'width' => '[0-9]+', 'height' => '[0-9]+', 'ext' => 'jpe?g|png|gif|JPG']);

Auth::routes();
// Authentication routes...
Route::get('login', ['uses' => 'UserController@getLogin', 'as' => 'login']);
Route::post('login', ['uses' => 'UserController@postLogin', 'as' => 'login.post']);
Route::get('logout', ['uses' => 'UserController@getLogout', 'middleware' => 'auth', 'as' => 'logout']);
Route::post('changelang', ['uses' => 'UserController@changelang', 'as' => 'change.lang']);
// Route::get('register', ['uses' => 'UserController@register', 'as' => 'register']);
// Route::post('register', ['uses' => 'UserController@postRegister', 'as' => 'register.post']);

Route::get('ads/{id}',function ($id){
    $ads = \App\Ads::findOrFail($id);
    $ads->visit = $ads->visit + 1 ;
    $ads->save();
    return redirect($ads->link);
})->name('ads.click');

Route::get('rss', function () {
    $nowdate = \Carbon\Carbon::now()->toDateTimeString();
    $news = \App\News::where('status', 'active')
        ->where('created_at', '<=', $nowdate)
        ->where('lang', \App::getLocale())
        ->orderBy('created_at', 'desc')
        ->take(20)
        ->get();
    $content = View::make('fa.rss')->with('news', $news);
    return Response::make($content, '200')->header('Content-Type', 'application/rss+xml');
});

Route::get('sitemap/tags/sitemap.xml', function () {	
    $nowdate = \Carbon\Carbon::now()->toDateTimeString();
    $tags = \App\Tag::where('created_at', '<=', $nowdate)
        ->orderBy('created_at', 'desc')
        ->get();
    $content = View::make('fa.sitemap-url')->with('tags', $tags);
    return Response::make($content, '200')->header('Content-Type', 'application/xhtml+xml;charset=UTF-8');
});

Route::get('sitemap/archive/sitemap.xml', function () {	
    $nowdate = \Carbon\Carbon::now()->toDateTimeString();
    $tags = \App\News::where('created_at', '<=', $nowdate)
		->where('status', 'active')
        ->orderBy('created_at', 'desc')
		->take(1000)
        ->get();
    $content = View::make('fa.sitemap-news')->with('tags', $tags);
    return Response::make($content, '200')->header('Content-Type', 'application/xhtml+xml;charset=UTF-8');
});

Route::get('sitemap/{id}/sitemap.xml', function ($id) {	
    $nowdate = \Carbon\Carbon::now()->toDateTimeString();
	$tag = \App\Tag::findOrFail($id);
    
	$news_titr1 = $tag->news()->where('status', 'active')->where('type', 'titr1')->where('news.created_at', '<=', $nowdate)
		->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take(1000)->get()->toArray();
	$news_titr2 = $tag->news()->where('status', 'active')->where('type', 'titr2')->where('news.created_at', '<=', $nowdate)
		->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take(1000)->get()->toArray();
	$news_titr3 = $tag->news()->where('status', 'active')->where('type', 'titr3')->where('news.created_at', '<=', $nowdate)
		->where('lang', \App::getLocale())->orderBy('created_at', 'desc')->take(1000)->get()->toArray();
	$tags = array_merge($news_titr1 ,  $news_titr2 , $news_titr3);
	
	$content = View::make('fa.sitemap-news')->with('tags', $tags);
    return Response::make($content, '200')->header('Content-Type', 'application/xhtml+xml;charset=UTF-8');
});

Route::get('sitemap.xml', function () {	
    $nowdate = \Carbon\Carbon::now()->toDateTimeString();
    $tags = \App\Tag::where('created_at', '<=', $nowdate)
        ->orderBy('created_at', 'desc')
        ->get();
    $content = View::make('fa.sitemap-tag')->with('tags', $tags);
    return Response::make($content, '200')->header('Content-Type', 'application/xhtml+xml;charset=UTF-8');
});

#auth
Route::group(['middleware' => 'auth'], function () {

    #### Filemanager ####
    Route::get('filemanager/show', ['uses' => 'FilemanagerController@show', 'as' => 'admin.filemanager.show']);
    Route::get('filemanager', ['uses' => 'FilemanagerController@index', 'as' => 'admin.filemanager']);
    Route::get('filemanager/only', ['uses' => 'FilemanagerController@index_only', 'as' => 'admin.filemanager.only']);
    Route::get('filemanager/create', ['uses' => 'FilemanagerController@index_create', 'as' => 'admin.filemanager.only.create']);
    Route::get('filemanager/multiple', ['uses' => 'FilemanagerController@multiple_file', 'as' => 'admin.filemanager.multiple']);
    Route::get('filemanager/audio', ['uses' => 'FilemanagerController@_audio', 'as' => 'admin.filemanager.audio']);
    Route::get('filemanager/files', ['uses' => 'FilemanagerController@_files', 'as' => 'admin.filemanager.files']);
    Route::get('filemanager/vid', ['uses' => 'FilemanagerController@_vid', 'as' => 'admin.filemanager.vid']);
    Route::get('filemanagersEditor', ['uses' => 'FilemanagerController@editor', 'as' => 'admin.filemanagersEditor']);
    Route::get('filemanagerConnector', ['uses' => 'FilemanagerController@create', 'as' => 'admin.filemanager.create']);
    Route::post('filemanagerConnector', ['uses' => 'FilemanagerController@create', 'as' => 'admin.filemanager.create']);
    Route::get('upload_editor', ['uses' => 'UserController@upload_editor', 'as' => 'upload.editor']);
    Route::get('upload_editor_file', ['uses' => 'UserController@upload_editor_file', 'as' => 'upload.editor']);
    Route::post('upload_file', ['as' => 'upload_file', 'uses' => 'UserController@upload_file']);

    #### Course ####
    Route::group(['prefix' => 'courses', 'as' => 'course.', 'namespace' => 'Course'], function () {

        Route::get('cat', ['uses' => 'CourseController@cat_list', 'as' => 'cat.list']);
        Route::post('cat', ['uses' => 'CourseController@cat_list_post', 'as' => 'cat.list.post']);

        Route::get('{cat_id?}', ['uses' => 'CourseController@course_list', 'as' => 'index']);
        Route::post('{cat_id?}', ['uses' => 'CourseController@course_list_post', 'as' => 'index.post']);

        Route::get('show/{id}', ['uses' => 'CourseController@show', 'as' => 'show']);

    });

    #### Peyment ####
    Route::group(['prefix' => 'peyment', 'as' => 'peyment.', 'namespace' => 'Peyment'], function () {

        Route::get('course/{id}', ['uses' => 'PeymentContoller@course', 'as' => 'course']);
        Route::post('course/{id}', ['uses' => 'PeymentContoller@course_post', 'as' => 'course.post']);

        Route::get('product/{id}', ['uses' => 'PeymentContoller@product', 'as' => 'product']);
        Route::post('product/{id}', ['uses' => 'PeymentContoller@product_post', 'as' => 'product.post']);
    });

    #### Profile ####
    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Profile'], function () {
        Route::get('/', ['uses' => 'ProfileController@index', 'as' => 'index']);
        Route::post('change/pass', ['uses' => 'ProfileController@change_pass', 'as' => 'change.pass']);
        /*Route::get('change/avatar', ['uses' => 'ProfileController@change_avatar', 'as' => 'change.avatar']);
        Route::post('change/avatar', ['uses' => 'ProfileController@change_avatar_post', 'as' => 'change.avatar.post']);*/
        Route::get('personal', ['uses' => 'ProfileController@personal', 'as' => 'personal']);
        Route::post('personal', ['uses' => 'ProfileController@personal_update', 'as' => 'personal']);
        Route::get('company/list', ['uses' => 'ProfileController@company_list', 'as' => 'company.list']);
        Route::post('company/list', ['uses' => 'ProfileController@company_list_post', 'as' => 'company.list.post']);
        Route::get('company/{id}/edit', ['uses' => 'ProfileController@company_edit', 'as' => 'company.edit']);
        Route::post('company/{id}/edit', ['uses' => 'ProfileController@company_edit_post', 'as' => 'company.edit.post']);

        Route::get('company/slider', ['uses' => 'ProfileController@company_slider', 'as' => 'company.slider']);
        Route::put('company/slider', ['uses' => 'ProfileController@company_slider_img', 'as' => 'company.slider.put']);
        Route::post('company/slider/store', ['uses' => 'ProfileController@company_slider_img_store', 'as' => 'company.slider.store']);
//        Route::post('company/{id}/edit', ['uses' => 'ProfileController@company_edit_post', 'as' => 'company.edit.post']);

        #### Products ####
//        Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
//            Route::post('cat/list', ['uses' => 'ProfileController@product_cat_list', 'as' => 'cat.list']);
//            Route::get('create', ['uses' => 'ProfileController@product_create', 'as' => 'create']);
//            Route::post('create', ['uses' => 'ProfileController@product_create_post', 'as' => 'create.post']);
//            Route::get('list', ['uses' => 'ProfileController@product_list', 'as' => 'list']);
//            Route::post('list', ['uses' => 'ProfileController@product_list_post', 'as' => 'list.post']);
//            Route::get('/', ['uses' => 'ProfileController@product_edit', 'as' => 'index']);
//            Route::get('{id}/edit', ['uses' => 'ProfileController@product_edit', 'as' => 'edit']);
//            Route::post('{id}/edit', ['uses' => 'ProfileController@product_edit_post', 'as' => 'edit.post']);
//            Route::put('rating', ['uses' => 'ProfileController@product_rating', 'as' => 'rating']);
//        });

    });

    #### Tag ####
    Route::group(['prefix' => 'tags', 'as' => 'tag.', 'namespace' => 'Tag\Admin'], function () {
        Route::post('items', ['uses' => 'TagController@items', 'as' => 'items']);
    });

    Route::get('newsletter', ['uses' => 'HomeController@newsletter', 'as' => 'newsletter']);

});

#### Products ####
//Route::group(['prefix' => 'products', 'as' => 'products.', 'namespace' => 'Product'], function () {
//    Route::get('/', ['uses' => 'ProductController@index', 'as' => 'index']);
//    Route::get('{id}/{title}', ['uses' => 'ProductController@show', 'as' => 'show']);
//    Route::get('categories/{id}/{title}', ['uses' => 'ProductController@categories_list', 'as' => 'categories.list']);
//    Route::get('user/{id}/{title}', ['uses' => 'ProductController@products_user', 'as' => 'user.list']);
//});

#### Comments ####
Route::group(['prefix' => 'comment', 'as' => 'comments.'], function () {
    Route::post('store', ['uses' => 'CommentController@store', 'as' => 'store']);
});

#### News ####
Route::group(['prefix' => 'news', 'as' => 'news.', 'namespace' => 'News'], function () {
//    Route::get('/', ['uses' => 'NewsController@index', 'as' => 'index']);
    Route::get('search', ['uses' => 'NewsController@search_news', 'as' => 'search']);
    #Route::get('{page?}', ['uses' => 'NewsController@index', 'as' => 'index'])->where('page', '\d+');
    Route::get('{id}/{title}', ['uses' => 'NewsController@show', 'as' => 'show']);
    Route::get('page/{id}/{title}', ['uses' => 'NewsController@page_show', 'as' => 'page.show']);
    Route::get('page/list/{id}/{title}', ['uses' => 'NewsController@page_list', 'as' => 'page.list']);

    #cat
    Route::get('cat/{id}/{title}', ['uses' => 'NewsController@cat_list', 'as' => 'cat.list']);
});

#### Tag ####
Route::group(['prefix' => 'tags', 'as' => 'tag.', 'namespace' => 'Tag'], function () {
    Route::get('/', ['uses' => 'TagController@items', 'as' => 'list']);
    Route::get('{id}/{title}', ['uses' => 'TagController@show', 'as' => 'show']);

    #### Json Tag Content ####
    Route::get('{id}/json/{page}', ['uses' => 'TagController@jsonLoadMore', 'as' => 'show'])->name('tag.json');
//    Route::get('{id}/{title}', ['uses' => 'TagController@shoarchivew', 'as' => 'show']);
});

### Ajax Routes ###
Route::get('json/titr3/{page}', ['uses' => 'HomeController@AjaxLoadMoreT3', 'as' => 'titr3.json']);



Route::get('about-us', 'HomeController@aboutus')->name('aboutus');
Route::get('contact-us', 'HomeController@contactus')->name('contactus');
Route::post('contact-us', 'HomeController@contactus_post')->name('contactus.post');
Route::post('newsletter', 'HomeController@newsletter_store')->name('newsletter.post');

Route::get('search', 'HomeController@search')->name('search');
Route::get('archive', 'HomeController@archive')->name('archive');
Route::get('archive/{month}', 'HomeController@archive_month')->name('archive.month');

############################ Admin ############################

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

    Route::get('/', 'News\Admin\NewsController@index')->name('dashboard');

    Route::group(['middleware' => 'access'], function () {

        Route::get('aboutus/{lang}', 'News\Admin\NewsController@aboutus')->name('aboutus');
        Route::post('aboutus', 'News\Admin\NewsController@aboutus_post')->name('aboutus.post');

        Route::get('setting', 'User\Admin\UserController@site_setting')->name('site.setting');
        Route::post('setting', 'User\Admin\UserController@site_setting_post')->name('site.setting.post');

        Route::get('contactus', 'News\Admin\NewsController@contactus')->name('contactus');
        Route::post('contactus', 'News\Admin\NewsController@contactus_list')->name('contactus.list');
        Route::put('contactus', 'News\Admin\NewsController@get_contactus')->name('get.contactus');
        Route::delete('contactus', 'News\Admin\NewsController@contactus_delete')->name('contactus.delete');

        #### Products ####
        Route::group(['prefix' => 'products', 'as' => 'products.', 'namespace' => 'Product\Admin'], function () {

            Route::get('/', ['uses' => 'ProductController@index', 'as' => 'index']);
            Route::get('/create', ['uses' => 'ProductController@create', 'as' => 'create']);
            Route::post('store', ['uses' => 'ProductController@store', 'as' => 'store']);
            Route::post('items', ['uses' => 'ProductController@items', 'as' => 'items']);
            Route::get('edit/{edit_id}', ['uses' => 'ProductController@edit', 'as' => 'edit'])->where('edit_id', '\d+');
            Route::post('store_edit', ['uses' => 'ProductController@update', 'as' => 'store.edit']);
            Route::delete('delete', ['uses' => 'ProductController@delete', 'as' => 'delete']);

        });


        #### Static Page ####
        Route::group(['prefix' => 'staticpage', 'as' => 'staticpage.', 'middleware' => 'access:staticpage', 'namespace' => 'Staticpage\Admin'], function () {

            Route::get('/', ['uses' => 'StaticpageController@index', 'as' => 'index']);
            Route::get('create', ['uses' => 'StaticpageController@create', 'as' => 'create']);
            Route::post('item/child', ['uses' => 'StaticpageController@item_child', 'as' => 'item.child']);
            Route::post('store', ['uses' => 'StaticpageController@store', 'as' => 'store']);
            Route::post('list', ['uses' => 'StaticpageController@_list', 'as' => 'list']);
            Route::get('{id}/edit', ['uses' => 'StaticpageController@admin_edit', 'as' => 'edit']);
            Route::post('update', ['uses' => 'StaticpageController@admin_update', 'as' => 'update']);
            Route::delete('delete', ['uses' => 'StaticpageController@admin_destroy', 'as' => 'delete']);
            Route::delete('deactive', ['uses' => 'StaticpageController@admin_deactive', 'as' => 'deactive']);

        });

        #### Sub Scriptions ####
        Route::group(['prefix' => 'subscriptions', 'as' => 'sub_scriptions.', 'namespace' => 'SubScriptions\Admin'], function () {

            Route::get('/', ['uses' => 'SubScriptionsController@index', 'as' => 'index']);
            Route::get('create', ['uses' => 'SubScriptionsController@create', 'as' => 'create']);
            Route::post('item/child', ['uses' => 'SubScriptionsController@item_child', 'as' => 'item.child']);
            Route::post('store', ['uses' => 'SubScriptionsController@store', 'as' => 'store']);
            Route::post('list', ['uses' => 'SubScriptionsController@_list', 'as' => 'list']);
            Route::get('{id}/edit', ['uses' => 'SubScriptionsController@edit', 'as' => 'edit']);
            Route::post('update', ['uses' => 'SubScriptionsController@update', 'as' => 'update']);
            Route::delete('delete', ['uses' => 'SubScriptionsController@destroy', 'as' => 'delete']);
            Route::delete('deactive', ['uses' => 'SubScriptionsController@deactive', 'as' => 'deactive']);

        });

        #### Product Cat ####
        Route::group(['prefix' => 'pcat', 'as' => 'product.cat.', 'middleware' => 'access:product_cat', 'namespace' => 'ProductCat\Admin'], function () {

            Route::get('{module_name}', ['uses' => 'ProductCatController@cat_index', 'as' => 'index', 'middleware' => 'access:product_cat']);
            Route::get('create/{module_name}', ['uses' => 'ProductCatController@cat_create', 'as' => 'create', 'middleware' => 'access:product_cat']);
            Route::post('create/{module_name}', ['uses' => 'ProductCatController@cat_store', 'as' => 'store', 'middleware' => 'access:product_cat']);
            Route::post('list/{module_name}', ['uses' => 'ProductCatController@cat_list', 'as' => 'list', 'middleware' => 'access:product_cat']);
            Route::get('{id}/edit/{module_name}', ['uses' => 'ProductCatController@cat_edit', 'as' => 'edit', 'middleware' => 'access:product_cat']);
            Route::post('edit/{module_name}', ['uses' => 'ProductCatController@cat_update', 'as' => 'update', 'middleware' => 'access:product_cat']);
            Route::delete('{id}/status/{module_name}', ['uses' => 'ProductCatController@cat_edit_status', 'as' => 'edit', 'middleware' => 'access:product_cat']);
            Route::delete('{id}/remove/{module_name}', ['uses' => 'ProductCatController@cat_remove', 'as' => 'edit', 'middleware' => 'access:product_cat']);

        });

        #### Tag ####
        Route::group(['prefix' => 'tags', 'as' => 'tag.', 'middleware' => 'access:ads', 'namespace' => 'Tag\Admin'], function () {
            Route::get('/', ['uses' => 'TagController@index', 'as' => 'index']);
            Route::get('create', ['uses' => 'TagController@create', 'as' => 'create', 'middleware' => 'access:news,unread,read']);
            Route::post('store', ['uses' => 'TagController@store', 'as' => 'store']);
            Route::post('list', ['uses' => 'TagController@_list', 'as' => 'list']);
            Route::get('{id}/edit', ['uses' => 'TagController@edit', 'as' => 'edit']);
            Route::post('update', ['uses' => 'TagController@update', 'as' => 'update']);
            Route::delete('delete', ['uses' => 'TagController@destroy', 'as' => 'delete']);
            Route::delete('deactive', ['uses' => 'TagController@deactive', 'as' => 'deactive']);

//            Route::post('items', ['uses' => 'TagController@items', 'as' => 'items']);

        });

//    #### Tag ####
//    Route::group(['prefix' => 'tags', 'as' => 'tag.', 'namespace' => 'Tag\Admin'], function () {
//
//    });


        #### ADS ####
        Route::group(['prefix' => 'ads', 'as' => 'ads.', 'middleware' => 'access:ads', 'namespace' => 'Ads\Admin'], function () {
            Route::get('/', ['uses' => 'AdsController@index', 'as' => 'index']);
            Route::get('create', ['uses' => 'AdsController@create', 'as' => 'create', 'middleware' => 'access:news,unread,read']);
            Route::post('store', ['uses' => 'AdsController@store', 'as' => 'store']);
            Route::post('list', ['uses' => 'AdsController@_list', 'as' => 'list']);
            Route::get('{id}/edit', ['uses' => 'AdsController@edit', 'as' => 'edit']);
            Route::post('update', ['uses' => 'AdsController@update', 'as' => 'update']);
            Route::delete('delete', ['uses' => 'AdsController@destroy', 'as' => 'delete']);
            Route::delete('deactive', ['uses' => 'AdsController@deactive', 'as' => 'deactive']);
        });

        #### Cat ####
        Route::group(['prefix' => 'cat', 'as' => 'cat.', 'middleware' => 'access:cat', 'namespace' => 'Cat\Admin'], function () {

            Route::get('{module_name}', ['uses' => 'CatController@cat_index', 'as' => 'index', 'middleware' => 'access:cat']);
            Route::get('create/{module_name}', ['uses' => 'CatController@cat_create', 'as' => 'create', 'middleware' => 'access:cat']);
            Route::post('create/{module_name}', ['uses' => 'CatController@cat_store', 'as' => 'store', 'middleware' => 'access:cat']);
            Route::post('list/{module_name}', ['uses' => 'CatController@cat_list', 'as' => 'list', 'middleware' => 'access:cat']);
            Route::get('{id}/edit/{module_name}', ['uses' => 'CatController@cat_edit', 'as' => 'edit', 'middleware' => 'access:cat']);
            Route::post('edit/{module_name}', ['uses' => 'CatController@cat_update', 'as' => 'update', 'middleware' => 'access:cat']);
            Route::delete('{id}/status/{module_name}', ['uses' => 'CatController@cat_edit_status', 'as' => 'edit', 'middleware' => 'access:cat']);
            Route::delete('{id}/remove/{module_name}', ['uses' => 'CatController@cat_remove', 'as' => 'edit', 'middleware' => 'access:cat']);

        });

        #### Course ####
        Route::group(['prefix' => 'course', 'as' => 'course.', 'namespace' => 'Course\Admin'], function () {

            Route::get('/', ['uses' => 'CourseController@index', 'as' => 'index']);
            Route::get('/create', ['uses' => 'CourseController@create', 'as' => 'create']);
            Route::post('store', ['uses' => 'CourseController@store', 'as' => 'store']);
            Route::post('items', ['uses' => 'CourseController@items', 'as' => 'items']);
            Route::get('edit/{edit_id}', ['uses' => 'CourseController@edit', 'as' => 'edit'])->where('edit_id', '\d+');
            Route::post('store_edit', ['uses' => 'CourseController@update', 'as' => 'store.edit']);
            Route::delete('delete', ['uses' => 'CourseController@delete', 'as' => 'delete']);

        });

        #### User ####
        Route::group(['prefix' => 'users', 'as' => 'users.', 'namespace' => 'User\Admin'], function () {

            Route::get('/', ['uses' => 'UserController@index', 'middleware' => 'access:user,list', 'as' => 'index']);
            Route::post('items', ['uses' => 'UserController@index_items', 'middleware' => 'access:user,list', 'as' => 'index_items']);
            Route::get('create', ['uses' => 'UserController@create', 'middleware' => 'access:user,manage', 'as' => 'create']);
            Route::post('/', ['uses' => 'UserController@store', 'middleware' => 'access:user,manage', 'as' => 'store']);
            Route::get('{id}', ['uses' => 'UserController@show', 'middleware' => 'access:user,manage', 'as' => 'show']);
            Route::get('{id}/edit', ['uses' => 'UserController@edit', 'middleware' => 'access:user,manage', 'as' => 'edit']);
            Route::put('{id}', ['uses' => 'UserController@update', 'middleware' => 'access:user,manage', 'as' => 'update']);
            Route::delete('{id}', ['uses' => 'UserController@destroy', 'middleware' => 'access:user,manage', 'as' => 'destroy']);
            Route::delete('{id}/active', ['uses' => 'UserController@active', 'middleware' => 'access:user,manage', 'as' => 'active']);

        });

    });


    #### Tag ####
    Route::group(['prefix' => 'tags', 'as' => 'tag.', 'namespace' => 'Tag\Admin'], function () {
        Route::post('items', ['uses' => 'TagController@items', 'as' => 'items']);
    });


    #### News ####
    Route::group(['prefix' => 'news', 'as' => 'news.', 'namespace' => 'News\Admin'], function () {
        Route::get('/', ['uses' => 'NewsController@index', 'as' => 'index']);
        Route::get('create', ['uses' => 'NewsController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'NewsController@store', 'as' => 'store']);
        Route::post('list', ['uses' => 'NewsController@_list', 'as' => 'list']);
        Route::get('{id}/edit', ['uses' => 'NewsController@edit', 'as' => 'edit']);
        Route::post('update', ['uses' => 'NewsController@update', 'as' => 'update']);
        Route::delete('delete', ['uses' => 'NewsController@destroy', 'as' => 'delete']);
        Route::delete('deactive', ['uses' => 'NewsController@deactive', 'as' => 'deactive']);

        Route::get('slider/list', ['uses' => 'NewsController@slider_list', 'as' => 'slider.list']);
        Route::post('slider/list', ['uses' => 'NewsController@slider_list_post', 'as' => 'slider.list.post']);
        Route::put('slider/list', ['uses' => 'NewsController@slider_list_put', 'as' => 'slider.list.put']);

    });

});


?>
